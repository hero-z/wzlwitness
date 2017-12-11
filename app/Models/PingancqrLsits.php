<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PingancqrLsits
 *
 * @property int $id
 * @property string|null $cno
 * @property int|null $user_id
 * @property string|null $user_name
 * @property string|null $from_info
 * @property int|null $num
 * @property int|null $s_num
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PingancqrLsits whereCno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PingancqrLsits whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PingancqrLsits whereFromInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PingancqrLsits whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PingancqrLsits whereNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PingancqrLsits whereSNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PingancqrLsits whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PingancqrLsits whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PingancqrLsits whereUserName($value)
 * @mixin \Eloquent
 */
class PingancqrLsits extends Model
{
    //
    protected  $fillable=['cno','user_id','user_name','from_info','num','s_num'];
}
