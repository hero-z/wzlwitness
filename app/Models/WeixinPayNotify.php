<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WeixinPayNotify
 *
 * @property int $id
 * @property string|null $store_type
 * @property string|null $store_id
 * @property string|null $store_name
 * @property string|null $template_id
 * @property string|null $receiver
 * @property string|null $topColor
 * @property string|null $linkTo
 * @property string|null $data
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WeixinPayNotify whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WeixinPayNotify whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WeixinPayNotify whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WeixinPayNotify whereLinkTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WeixinPayNotify whereReceiver($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WeixinPayNotify whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WeixinPayNotify whereStoreName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WeixinPayNotify whereStoreType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WeixinPayNotify whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WeixinPayNotify whereTopColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WeixinPayNotify whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class WeixinPayNotify extends Model
{
    //

    protected  $fillable=['store_type','store_id','store_name','template_id','receiver','topColor','linkTo','data'];
}
