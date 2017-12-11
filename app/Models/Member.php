<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    //
    protected  $fillable=['ali_buyerid','wxopenid','point','phone','wx_nickname','subscribe_store_id','is_subscribed','latitude','longitude','created_at',"updated_at"];
}
