<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\EmployeeMaster;
use App\Models\State;
use App\Http\Requests\RegisterStoreRequest;
use App\Traits\CommonFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use CommonFunction;

    protected mixed $error_message, $controller_name;

    public function __construct()
    {
        $this->error_message = config('constants.error_responses.message');
        $this->controller_name = "App\Http\Controllers\Admin\PermissionController";
    }

    public function loginForm(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.auth.login');
    }

    public function registerForm(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $countries = Country::select('id', 'name')->get();
        return view('admin.auth.register', [
            'countries' => $countries,
        ]);
    }

    public function getStates(Request $request, $country): \Illuminate\Http\JsonResponse
    {
        $function_name = 'getStates';
        try {
            $states = State::where('country_id', $country)->select('id', 'name')->get();
            return response()->json($states);
        } catch (\Exception $e) {
            logError($this->controller_name, $function_name, $e);
        }
    }

    public function getCity(Request $request, $state): \Illuminate\Http\JsonResponse
    {
        $function_name = 'getCity';
        try {
            $cities = City::where('state_id', $state)->select('id', 'name')->get();
            return response()->json($cities);
        } catch (\Exception $e) {
            logError($this->controller_name, $function_name, $e);
        }
    }

    public function register(RegisterStoreRequest $request)
    {
        $function_name = 'register';
        try {
            $validated = $request->validated();
            if ($validated) {
                EmployeeMaster::create([
                    'employee_name' => $request->employee_name,
                    'employee_code' => $request->employee_code,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'username' => $request->username,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'password' => Hash::make($request->password),
                    'address' => $request->address,
                    'country' => $request->country,
                    'state' => $request->state,
                    'city' => $request->city,
                    'zip' => $request->zip,
                ]);
                return $this->sendResponse('Employee Register successfully');
            }
        } catch (\Exception $e) {
            logError($this->controller_name, $function_name, $e);
        }
    }

    public function login(Request $request)
    {
        $function_name = 'login';
        try {
            if (Auth::guard('admin')->check()) {
                return redirect()->route('admin.dashboard');
            }
            if ($request->isMethod('post')) {
                $rules = [
                    'email' => 'required|email|max:255',
                    'password' => 'required',
                ];
                $messages = [
                    'email.required' => 'Email Address is required',
                    'email.email' => 'Valid Email is required',
                    'password.required' => 'Password is required',
                ];
                $this->validate($request, $rules, $messages);
                if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->back()->with('error', 'Invalid Email or Password');
                }
            }
        } catch (\Exception $e) {
            logError($this->controller_name, $function_name, $e);
        }
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {
        $function_name = 'logout';
        try {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.auth.login-form');
        } catch (\Exception $e) {
            logError($this->controller_name, $function_name, $e);
        }
    }
}
