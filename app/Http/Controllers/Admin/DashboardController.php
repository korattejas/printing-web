<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeLeaveMaster;
use App\Models\LeaveBalance;
use App\Models\LeaveMaster;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $get_total_leave_list = LeaveBalance::leftjoin('leave_master', 'leave_master.id', 'leave_balance.leave_type')
            ->select('leave_master.leaveType', 'leave_balance.leave_balance')->get();
        $employeeCode = auth()->guard('admin')->user()->employee_code;
        $total_use_leave_balance = EmployeeLeaveMaster::where('employee_code', $employeeCode)->sum('number_of_days');
        $total_leave = $get_total_leave_list->sum('leave_balance');
        $total_available_leave_balance =  $total_leave - $total_use_leave_balance;
        return view('admin.dashboard.dashboard',[
            'get_total_leave_list' => $get_total_leave_list,
            'total_use_leave_balance' => $total_use_leave_balance,
            'total_available_leave_balance' => $total_available_leave_balance,
            'total_leave' => $total_leave
        ]);
    }

    public function home()
    {
        return view('admin.dashboard.home');
    }
}
