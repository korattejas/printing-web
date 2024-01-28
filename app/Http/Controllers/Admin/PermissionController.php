<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\PermissionStoreRequest;
use App\Traits\CommonFunction;


class PermissionController extends Controller
{
    use CommonFunction;

    protected mixed $error_message, $validator_error_code, $backend_error_code, $success_status_code, $controller_name;

    public function __construct()
    {
        $this->error_message = config('constants.error_responses.message');
        $this->controller_name = "App\Http\Controllers\Admin\PermissionController";
    }

    public function index()
    {
        $function_name = 'index';
        try {
            return view('admin.permissions.index');
        } catch (\Exception $e) {
            logError($this->controller_name, $function_name, $e);
        }
    }

    public function getDataTablePermission(Request $request): \Illuminate\Http\JsonResponse
    {
        $function_name = 'index';
        try {
            if ($request->ajax()) {
                $permission = DB::table('permissions')->select(['id', 'name', 'guard_name', 'created_at']);
                return DataTables::of($permission)
                    ->addColumn('action', function ($permission) {
                        $action_array = [
                            'is_simple_action' => 1,
                            'edit_route' => route('permission.edit', encryptId($permission->id)),
                            'delete_id' => encryptId($permission->id),
                            'hidden_id' => encryptId($permission->id),
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
            return view('admin.permissions.create');
        } catch (\Exception $e) {
            logError($this->controller_name, $function_name, $e);
        }
    }

    public function edit($id)
    {
        $function_name = 'edit';
        try {
            $permission = Permission::where('id', decryptId($id))->first();
            if ($permission) {
                return view('admin.permissions.edit', [
                    'permission' => $permission
                ]);
            } else {
                abort(404);
            }
        } catch (\Exception $e) {
            logError($this->controller_name, $function_name, $e);
        }
    }


    public function store(PermissionStoreRequest $request)
    {
        $function_name = 'store';
        try {
            $id = $request->input('edit_value');
            $validated = $request->validated();
            if ($validated) {
                if (decryptId($id) == 0) {
                    Permission::create([
                        'name' => $request->permission_name,
                        'guard_name' => $request->guard_name,
                    ]);
                    return $this->sendResponse('Permission create successfully');
                } else {
                    $permission = Permission::where('id', decryptId($id))->first();
                    if ($permission) {
                        $permission->update([
                            'name' => $request->permission_name,
                            'guard_name' => $request->guard_name,
                        ]);
                    }
                    return $this->sendResponse('Permission update successfully');
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
            Permission::where('id', decryptId($id))->delete();
            return $this->sendResponse('Permission delete successfully');
        } catch (\Exception $e) {
            logError($this->controller_name, $function_name, $e);
        }
    }
}
