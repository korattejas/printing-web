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

    public function getDataTablePermission(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($request->ajax()) {
            $permission = DB::table('permissions')->select(['id', 'name', 'guard_name', 'created_at']);
            return DataTables::of($permission)
                ->addColumn('action', function ($permission) {
                    $action_array = [
                        'is_simple_action' => 1,
//                        'edit_route' => route('admin.category.edit', $category->id),
                        'delete_id' => $permission->id,
                        'hidden_id' => $permission->id,
                    ];
                    return view('admin.render_view.datable_action', [
                        'action_array' => $action_array
                    ])->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }
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
