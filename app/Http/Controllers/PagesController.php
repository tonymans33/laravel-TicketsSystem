<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{

    //the get started page
    public function index()
    {
        return view('Pages.index');
    }

    //return to the login page
    public function getIn()
    {
        return view('Pages.getIn');
    }

    //function to change the language
    public function locale($locale)
    {
        Session::put('locale' , $locale);
        return redirect()->back();
    }
}
