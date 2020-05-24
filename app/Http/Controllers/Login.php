<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Login extends Controller
{
    public function index()
    {
    	$data['title'] = 'Login';
    	return view('login', $data);
    }

    public function register()
    {
    	$data['title'] = 'Register';
    	return view('register', $data);
    }

    public function saveUser(Request $request)
    {
    	$request->validate([
    		"fname"=>'required'
    	]);
    	return $request->all();
    }
}
