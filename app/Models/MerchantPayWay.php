<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MerchantPayWay
 *
 * @property int $id
 * @property int|null $merchant_id
 * @property string|null $weixin
 * @property string|null $alipay
 * @property string|null $jd
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantPayWay whereAlipay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantPayWay whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantPayWay whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantPayWay whereJd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantPayWay whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantPayWay whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\MerchantPayWay whereWeixin($value)
 * @mixin \Eloquent
 */
class MerchantPayWay extends Model
{
    //
protected  $fillable=['merchant_id','weixin','alipay','jd'];
}
