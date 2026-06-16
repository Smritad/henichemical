<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	public function user_home()
    {
        return view('user.user-home');
    }
}
