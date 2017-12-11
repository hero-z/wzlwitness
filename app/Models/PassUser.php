<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PassUser extends Model
{
    protected $fillable=['user_id',"tpl_id",'serial_number',"channel_id"];
}
