<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // public function index()
    // {
    //     return view('admin.admin');
    // }
    public function index()
    {
        $usertype = Auth::user()->usertype;
        if ($usertype == '1') {
            return view('admin.admin');
        } else {
            return view('user.home');
        }
    }
}
