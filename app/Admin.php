<?php

namespace App;
use App\Ticket;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';

    function ticket()
    {
        return $this->hasMany('App\Ticket', 'added_by' , 'username');
    }

    static function checkForUsername($username)
    {
        $check =  Admin::where('username' , $username)->get();
        return $check;
    }

    static function getData($username)
    {
        $data =  Admin::where('username' , $username)->first();
        return $data;
    }
    static function getDataWithEmail($email)
    {
        $data =  Admin::where('email' , $email)->first();
        return $data;
    }

    static function checkIfLoggedIn($email , $password)
    {
        $check =  Admin::where('password' , $password)->where('email' , $email)->get();
        return $check;
    }


}
