<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PufaBank
 *
 * @property int $id
 * @property string $bankname 银行名称
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaBank whereBankname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaBank whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaBank whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaBank whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PufaBank extends Model
{
    //
    // protected $fillable=['user_id', 'auth_app_id','app_auth_token', 'app_refresh_token', 'expires_in' , 're_expires_in'];
}
