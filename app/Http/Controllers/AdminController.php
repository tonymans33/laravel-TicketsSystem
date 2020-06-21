<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    //function to return to the create new admin page
    public function createAdmin()
    {
        return view('pages.createAdmin');
    }

    //function to store new admin data in the database
    public function storeAdmin(Request $request)
    {
        $this->validate($request,[
            'username' => 'required',
            'email' => 'required'
        ]);

        $admin = new Admin();
        $admin->username = $request->input('username');
        $admin->email = $request->input('email');
        $admin->closed = 'yes';
        $admin->added_by = session('userData') ['username']; //user who is logged in the moment
        $admin->password = '123';

        /*Check if the radio inputs in fill and if not put a default value to it 'none' */
        if(empty($request->input('create')))
        {
            $admin->create = 'no';
        }
        else{
            $admin->create = 'yes';
        }
        if(empty($request->input('edit')))
        {
            $admin->edit = 'no';
        }
        else
        {
            $admin->edit = 'yes';
        }
        if(empty($request->input('delete')))
        {
            $admin->delete = 'no';
        }
        else
        {
            $admin->delete = 'yes';
        }
        if(empty($request->input('close')))
        {
            $admin->close = 'no';
        }
        else{
            $admin->close = 'yes';
        }
        if(empty($request->input('open')))
        {
            $admin->open = 'no';
        }
        else
        {
            $admin->open = 'yes';
        }
        if(empty($request->input('reopen')))
        {
            $admin->reopen = 'no';
        }
        else
        {
            $admin->reopen = 'yes';
        }


        $admin->save();
        return redirect('/home')->with('success' , __('Admin is successfully added!'));
    }

    //function to login
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $password = $request->get('password');
        $email = $request->get('email');

        $check = Admin::checkIfLoggedIn($email , $password);
        if($check != '[]')
        {

            $getUserData = Admin::getDataWithEmail($email);
            //user data to manipulate actions in dashboard table 'roles'
            $userData = [
                'edit' => $getUserData->edit,
                'open' => $getUserData->open,
                'delete' => $getUserData->delete,
                'create' => $getUserData->create,
                'username' => $getUserData->username,
                'email' => $getUserData->email,
                'password' => $getUserData->password,
                'id' => $getUserData->id
            ];

            \session()->put('userData' , $userData);

            return redirect('/home')->with('success' , __('You Are Successfully logged in'));
        }
        else
        {
            return back()->with('error' , __('Invalid Email Or Password !'));
        }
    }

    //function to logout
    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success' , __('You Are Logged out !'));
    }

    //view the update data
    public function updateData()
    {
        $id = session('userData') ['id'];

        $admin = Admin::find($id);
        return view('Pages.updateData' ,compact( 'admin'));
    }

    //function to store updated data
    public function update(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $id = session('userData') ['id'];

        $admin = Admin::find($id);

        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->password = $request->password;

        $admin->save();
        return redirect('/getIn')->with('success', __('Your Data is Successfully Updated please login again'));
    }




}
