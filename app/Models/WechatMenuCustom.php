<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\WechatMenuCustom
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $type
 * @property string|null $url
 * @property string|null $key_respond
 * @property int|null $status
 * @property int|null $pid
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenuCustom whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenuCustom whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenuCustom whereKeyRespond($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenuCustom whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenuCustom wherePid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenuCustom whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenuCustom whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenuCustom whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\WechatMenuCustom whereUrl($value)
 * @mixin \Eloquent
 */
class WechatMenuCustom extends Model
{
    //
    protected  $fillable=['name','type','url','key_respond','status','pid','updated_at'];

}
