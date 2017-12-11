<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WebankQrListInfo
 *
 * @mixin \Eloquent
 */
class WebankQrListInfo extends Model
{
    protected $table = 'wb_qr_list_infos';
    protected  $fillable=['user_id','code_number','code_type','store_id','cno'];
}
