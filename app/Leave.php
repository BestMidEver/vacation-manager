<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
        'user_id', 'administrator_id', 'mode', 'start_date', 'vacation_days',
    ];
}
