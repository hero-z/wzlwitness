<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AlipayIsvConfig
 *
 * @property int $id
 * @property string $app_id
 * @property string $pid
 * @property string $rsaPrivateKey
 * @property string $rsaPrivateKeyFilePath
 * @property string $alipayrsaPublicKey
 * @property string $rsaPublicKeyFilePath
 * @property string $callback
 * @property string $operate_notify_url
 * @property string $notify
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayIsvConfig whereAlipayrsaPublicKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayIsvConfig whereAppId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayIsvConfig whereCallback($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayIsvConfig whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayIsvConfig whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayIsvConfig whereNotify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayIsvConfig whereOperateNotifyUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayIsvConfig wherePid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayIsvConfig whereRsaPrivateKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayIsvConfig whereRsaPrivateKeyFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayIsvConfig whereRsaPublicKeyFilePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayIsvConfig whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AlipayIsvConfig extends Model
{
    //
    protected  $fillable=['app_id','pid','operate_notify_url','rsaPrivateKey','rsaPrivateKeyFilePath','alipayrsaPublicKey','rsaPublicKeyFilePath','callback','notify'];
}
