<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class SubAdminContoller extends Controller
{
    public function index()
    {
        return view('admin.sub_admins.index');
    }

    public function create()
    {
        return view('admin.sub_admins.create');
    }

    public function store(Request $request)
    {
        

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => $request->password,
        ]);
    }
}
