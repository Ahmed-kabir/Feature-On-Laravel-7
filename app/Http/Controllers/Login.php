<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Illuminate\Support\Facades\Crypt;

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
    		"fname"=>'required',
    		"lname"=>'required',
    		"email"=>'required'	
    	]);
		$password =  $request->input('password');
    	$confirm_password =  $request->input('confirm_password');
    	$pass = bcrypt($password);
    	$confirm_password = bcrypt($confirm_password);
		
    	$data['fname'] = $request->input('fname');
    	$data['lname'] = $request->input('lname');
    	$data['email'] = $request->input('email');
    	
    	$data['password'] =  $pass;
    	$data['confirm_password'] =  $confirm_password;
    	$data['reg_time'] = date('Y-m-d H:i:s');

    	 DB::table('logins')->insert($data);
    	 $message = "Registration Completed Successfully";
    	 // Session::put('success_message', $message);
    	 session()->flash('success_message', $message);
    	 // return back()->with('message','data saved successfully');
    	 return redirect('/register');
    	
    	// return $request->all();
    	// return $data;
    }

    public function loginVerify(Request $request)
    {
    	$email = $request->input('email');
    	$password = $request->input('password');

			$users = DB::table('logins')
              ->where("email", "=", $email)
              ->first();
              $db_pass = $users->password;
              $fname = $users->fname;
              $lname = $users->lname;
              $access_point = $users->access_point;

              $data['title'] = 'Admin Dashboard';
                 
             
             

		// $confirm_password = bcrypt($password);
		// $db_pass='$2y$10$nfphh1UeJueYOXbWDhx4SO0wFhuJhImKM63GaEvJBMBF.A4WxilsO';
		$result = password_verify($password, $db_pass);
		if($result != '')
		{
		Session::put('userData', ['fname' => $fname, 'lname' => $lname, 'access_point' => $access_point]);
			// return view('admin_dashboard', $data);
        return redirect('/dashboard');
		}
		else
		{
			// echo 'fake user';
			// $msg = 'Something wrong';
			// Session::put('error_msg', $msg);
			return redirect('/login')->with('message', 'Something Wrong');
		}
    	// return $confirm_password;
    	// return $request->all();
    }

    public function dashboard()
    {
         $data['title'] = 'Admin Dashboard';
         return view('admin_dashboard', $data);
    }

    public function logout(Request $request)
    {
    	// Session::forget('userData');
    	Session::flush();
    	return redirect('/login');
    }

    public function setPasswordForsession(Request $request)
    {
    	$password = $request->input('password');
    	 Session::put('password', $password);
    	 echo 'done';

    }

    public function checkPasswordForsession(Request $request)
    {
    	$confirm_password = $request->input('confirm_password');
    	$password = Session::get('password');
    	if($confirm_password == $password)
    	{
    		echo 'success';
    	}
    	else
    	{
    		echo 'failed';
    	}
    }
}
