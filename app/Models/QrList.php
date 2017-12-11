<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\QrList
 *
 * @property int $id
 * @property string|null $cno
 * @property int|null $user_id
 * @property int|null $num
 * @property int|null $s_num
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrList whereCno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrList whereNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrList whereSNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\QrList whereUserId($value)
 * @mixin \Eloquent
 */
class QrList extends Model
{
    //
    protected  $fillable=['cno','user_id','num','s_num'];

}
