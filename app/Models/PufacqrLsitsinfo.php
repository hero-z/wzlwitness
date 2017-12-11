<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PufacqrLsitsinfo
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $user_name
 * @property string|null $code_number
 * @property int|null $code_type
 * @property string|null $store_id
 * @property string|null $store_name
 * @property string|null $from_info
 * @property string|null $cno
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufacqrLsitsinfo whereCno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufacqrLsitsinfo whereCodeNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufacqrLsitsinfo whereCodeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufacqrLsitsinfo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufacqrLsitsinfo whereFromInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufacqrLsitsinfo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufacqrLsitsinfo whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufacqrLsitsinfo whereStoreName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufacqrLsitsinfo whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufacqrLsitsinfo whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufacqrLsitsinfo whereUserName($value)
 * @mixin \Eloquent
 */
class PufacqrLsitsinfo extends Model
{
    //
    protected  $fillable=['user_id','user_name','code_number','code_type','store_id','store_name','from_info','cno'];
}
