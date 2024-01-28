<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.permissions.index');
    }

    public function getDataTablePermission(): \Illuminate\Http\JsonResponse
    {
        $permissions = DB::table('permissions')->select(['id', 'name', 'guard_name', 'created_at']);

        return DataTables::of($permissions)
            ->addColumn('action', function ($permissions) {
                return '<a href="#" class="btn btn-sm btn-primary">Edit</a>
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteTask' . $permissions->id . '">Delete</button>';
            })
            ->make(true);
    }

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.permissions.create');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {

        $request->validate([
            'permission_name' => 'required',
            'guard_name' => 'required',
        ]);
        Permission::create([
            'name' => $request->permission_name,
            'guard_name' => $request->guard_name,
        ]);
        return redirect()->route('admin.permission.index');
    }
}
