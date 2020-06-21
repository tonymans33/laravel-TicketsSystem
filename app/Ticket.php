<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Admin;

class Ticket extends Model
{
    protected $table = 'tickets';

    function admin()
    {
        return $this->belongsTo('App\Admin', 'username' , 'added_by');
    }

    static function getBelongsToUser($username)
    {
        return Ticket::where('added_by', $username)->orWhere('assin_to' , $username);
    }



}
