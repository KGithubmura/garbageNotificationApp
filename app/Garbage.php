<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Garbage extends Model
{
    protected $guarded = array('id');
    public static $rules = array(
        'garbageType' => 'required',
        'dayOf' => 'required',
        'notification_date' => 'required',
    );
    
}
