<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PufaTradeQueries
 *
 * @property int $id
 * @property string|null $out_trade_no 商铺流水号
 * @property string|null $transaction_id 威富通订单号
 * @property string|null $out_transaction_id 支付流水号，支付宝或者其他机构生成的流水号
 * @property string $store_id 商铺号
 * @property string|null $type 支付类型，ali或者微信等等
 * @property float|null $total_amount 支付金额
 * @property string|null $status 订单交易状态
 * @property string|null $mark 三方的状态码
 * @property string|null $buyer 买家支付宝id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string $cashier_id 收银员id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaTradeQueries whereBuyer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaTradeQueries whereCashierId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaTradeQueries whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaTradeQueries whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaTradeQueries whereMark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaTradeQueries whereOutTradeNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaTradeQueries whereOutTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaTradeQueries whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaTradeQueries whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaTradeQueries whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaTradeQueries whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaTradeQueries whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaTradeQueries whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PufaTradeQueries extends Model
{
    //
    // protected  $fillable=[];

}
