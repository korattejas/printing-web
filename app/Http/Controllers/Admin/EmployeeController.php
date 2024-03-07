<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLeaveMaster;
use App\Models\LeaveBalance;
use App\Models\LeaveMaster;
use App\Models\NonWorkingDay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\LeaveStoreRequest;
use App\Traits\CommonFunction;


class EmployeeController extends Controller
{
    use CommonFunction;

    protected mixed $error_message, $controller_name;

    public function __construct()
    {
        $this->error_message = config('constants.error_responses.message');
        $this->controller_name = "App\Http\Controllers\Admin\EmployeeController";
    }

    public function index()
    {
        $function_name = 'index';
        try {
            return view('admin.leave_record.index');
        } catch (\Exception $e) {
            logError($this->controller_name, $function_name, $e);
        }
    }

    public function getDatatableLeaveRecord(Request $request): \Illuminate\Http\JsonResponse
    {
        $function_name = 'getDatatableLeaveRecord';
        try {
            if ($request->ajax()) {
                $employeeCode = auth()->guard('admin')->user()->employee_code;
                $leaveRecord = DB::table('employee_leave_master')->where('employee_leave_master.employee_code', $employeeCode)
                    ->leftjoin('leave_master', 'leave_master.id', 'employee_leave_master.leave_type')
                    ->select(['leave_master.leaveType as leave_type_name', 'employee_leave_master.id', 'employee_leave_master.leave_type', 'employee_leave_master.employee_code', 'employee_leave_master.from_date', 'employee_leave_master.to_date', 'employee_leave_master.number_of_days', 'employee_leave_master.comment']);
                return DataTables::of($leaveRecord)
                    ->addColumn('action', function ($leaveRecord) {
                        $action_array = [
                            'is_simple_action' => 1,
                            'edit_route' => route('leave-record.edit', encryptId($leaveRecord->id)),
                            'delete_id' => encryptId($leaveRecord->id),
                            'hidden_id' => encryptId($leaveRecord->id),
                        ];
                        return view('admin.render_view.datable_action', [
                            'action_array' => $action_array
                        ])->render();
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
        } catch (\Exception $e) {
            logError($this->controller_name, $function_name, $e);
        }
    }

    public function create()
    {
        $function_name = 'create';
        try {
            $leaveTypes = LeaveMaster::select('id', 'leaveType')->get();
            return view('admin.leave_record.create', [
                'leaveTypes' => $leaveTypes,
            ]);
        } catch (\Exception $e) {
            logError($this->controller_name, $function_name, $e);
        }
    }

    public function edit($id)
    {
        $function_name = 'edit';
        try {
            $leave = EmployeeLeaveMaster::where('id', decryptId($id))->first();
            $leaveTypes = LeaveMaster::select('id', 'leaveType')->get();
            if ($leave) {
                return view('admin.leave_record.edit', [
                    'leave' => $leave,
                    'leaveTypes' => $leaveTypes,
                ]);
            } else {
                abort(404);
            }
        } catch (\Exception $e) {
            logError($this->controller_name, $function_name, $e);
        }
    }


    public function store(LeaveStoreRequest $request)
    {
        $function_name = 'store';
        try {
            $id = $request->input('edit_value');
            $validated = $request->validated();
            if ($validated) {
                $employeeCode = auth()->guard('admin')->user()->employee_code;
                $fromDate = Carbon::parse($request->from_date);
                $toDate = Carbon::parse($request->to_date);
                $countDay = $toDate->diffInDays($fromDate) + 1;

                $nonWorkingDays = NonWorkingDay::whereIn('date', $this->getDateRange($fromDate, $toDate))->count();
                if ($nonWorkingDays > 0) {
                    return $this->sendError('Some of the selected leave days are non-working days. Please choose different dates.');
                }

                $total_use_leave_balance = EmployeeLeaveMaster::where('leave_type', $request->leave_type)->where('employee_code', $employeeCode)->sum('number_of_days');
                $get_leave_type_balance = LeaveBalance::where('leave_type', $request->leave_type)->value('leave_balance');
                if ($total_use_leave_balance !== null && $get_leave_type_balance !== null) {
                    if ($get_leave_type_balance < $total_use_leave_balance || $get_leave_type_balance < ($total_use_leave_balance + $countDay)) {
                        return $this->sendError('Your leave balance has already been used.');
                    }
                }

                if (decryptId($id) == 0) {
                    EmployeeLeaveMaster::create([
                        'leave_type' => $request->leave_type,
                        'employee_code' => $request->employee_code,
                        'from_date' => $request->from_date,
                        'to_date' => $request->to_date,
                        'number_of_days' => $countDay,
                        'comment' => $request->comment,
                    ]);
                    return $this->sendResponse('Leave add successfully');
                } else {
                    $leaveRecord = EmployeeLeaveMaster::where('id', decryptId($id))->first();
                    if ($leaveRecord) {
                        $leaveRecord->update([
                            'leave_type' => $request->leave_type,
                            'employee_code' => $request->employee_code,
                            'from_date' => $request->from_date,
                            'to_date' => $request->to_date,
                            'number_of_days' => $countDay,
                            'comment' => $request->comment,
                        ]);
                    }
                    return $this->sendResponse('Leave update successfully');
                }
            }
        } catch (\Exception $e) {
            logError($this->controller_name, $function_name, $e);
        }
    }

    private function getDateRange($startDate, $endDate): array
    {
        $function_name = 'getDateRange';
        try {
            $dates = [];
            for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
                $dates[] = $date->format('Y-m-d');
            }
            return $dates;
        } catch (\Exception $e) {
            logError($this->controller_name, $function_name, $e);
        }
    }

    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $function_name = 'destroy';
        try {
            EmployeeLeaveMaster::where('id', decryptId($id))->delete();
            return $this->sendResponse('Leave delete successfully');
        } catch (\Exception $e) {
            logError($this->controller_name, $function_name, $e);
        }
    }
}
