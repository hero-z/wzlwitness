<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PufaShopCategory
 *
 * @property int $id
 * @property int $industry 行业类别号
 * @property string $rawstr 类别名称
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaShopCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaShopCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaShopCategory whereIndustry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaShopCategory whereRawstr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaShopCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PufaShopCategory extends Model
{
    //
    // protected  $fillable=['category_id','category_name','level','link'];
}
