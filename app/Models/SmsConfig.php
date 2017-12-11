<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SmsConfig
 *
 * @property int $id
 * @property string|null $app_key
 * @property string|null $app_secret
 * @property string $SignName
 * @property string $TemplateCode
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsConfig whereAppKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsConfig whereAppSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsConfig whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsConfig whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsConfig whereSignName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsConfig whereTemplateCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SmsConfig whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SmsConfig extends Model
{
    //
    protected $fillable=['app_key','app_secret','SignName','TemplateCode'];
}
