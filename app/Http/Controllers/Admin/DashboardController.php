<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index(){
        $user = \App\Models\User::find(1); // Change ID as needed
        $user->assignRole('superadmin');
        return view('admin.dashboard');
    }
}
