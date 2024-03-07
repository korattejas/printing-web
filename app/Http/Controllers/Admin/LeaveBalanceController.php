<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveBalance;
use App\Models\LeaveMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\LeaveBalanceStoreRequest;
use App\Traits\CommonFunction;


class LeaveBalanceController extends Controller
{
    use CommonFunction;

    protected mixed $error_message, $controller_name;

    public function __construct()
    {
        $this->error_message = config('constants.error_responses.message');
        $this->controller_name = "App\Http\Controllers\Admin\LeaveBalanceController";
    }

    public function index()
    {
        $function_name = 'index';
        try {
            return view('admin.leave_balance.index');
        } catch (\Exception $e) {
            logError($this->controller_name, $function_name, $e);
        }
    }

    public function getDatatableLeaveBalance(Request $request): \Illuminate\Http\JsonResponse
    {
        $function_name = 'getDatatableLeaveBalance';
        try {
            if ($request->ajax()) {
                $leaveRecord = DB::table('leave_balance')
                    ->leftjoin('leave_master', 'leave_master.id', 'leave_balance.leave_type')
                    ->select(['leave_master.leaveType as leave_type_name', 'leave_balance.id', 'leave_balance.leave_balance']);
                return DataTables::of($leaveRecord)
                    ->addColumn('action', function ($leaveRecord) {
                        $action_array = [
                            'is_simple_action' => 1,
                            'edit_route' => route('leave-balance.edit', encryptId($leaveRecord->id)),
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
            return view('admin.leave_balance.create', [
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
            $leaveBalance = LeaveBalance::where('id', decryptId($id))->first();
            $leaveTypes = LeaveMaster::select('id', 'leaveType')->get();
            if ($leaveBalance) {
                return view('admin.leave_balance.edit', [
                    'leaveBalance' => $leaveBalance,
                    'leaveTypes' => $leaveTypes,
                ]);
            } else {
                abort(404);
            }
        } catch (\Exception $e) {
            logError($this->controller_name, $function_name, $e);
        }
    }


    public function store(LeaveBalanceStoreRequest $request)
    {
        $function_name = 'store';
        try {
            $id = $request->input('edit_value');
            $validated = $request->validated();
            if ($validated) {
                if (decryptId($id) == 0) {
                    LeaveBalance::create([
                        'leave_type' => $request->leave_type,
                        'leave_balance' => $request->leave_balance,
                    ]);
                    return $this->sendResponse('Leave balance add successfully');
                } else {
                    $leavealanceRecord = LeaveBalance::where('id', decryptId($id))->first();
                    if ($leavealanceRecord) {
                        $leavealanceRecord->update([
                            'leave_type' => $request->leave_type,
                            'leave_balance' => $request->leave_balance,
                        ]);
                    }
                    return $this->sendResponse('Leave balance update successfully');
                }
            }
        } catch (\Exception $e) {
            logError($this->controller_name, $function_name, $e);
        }
    }

    public function destroy(string $id): \Illuminate\Http\JsonResponse
    {
        $function_name = 'destroy';
        try {
            LeaveBalance::where('id', decryptId($id))->delete();
            return $this->sendResponse('Leave balance delete successfully');
        } catch (\Exception $e) {
            logError($this->controller_name, $function_name, $e);
        }
    }
}
