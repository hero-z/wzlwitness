<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SelfServiceShop
 *
 * @property int $id
 * @property string|null $store_id
 * @property int|null $user_id
 * @property string|null $brand_name
 * @property string|null $brand_logo
 * @property string|null $main_shop_name
 * @property string|null $branch_shop_name
 * @property string|null $province_code
 * @property string|null $city_code
 * @property string|null $district_code
 * @property string|null $address
 * @property string|null $contact_number
 * @property string|null $main_image
 * @property string|null $category_name
 * @property string|null $contact_name
 * @property string|null $audit_images1
 * @property string|null $audit_images2
 * @property string|null $audit_images3
 * @property string|null $licence
 * @property string|null $business_certificate
 * @property string|null $auth_letter
 * @property string|null $other_authorization
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereAuditImages1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereAuditImages2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereAuditImages3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereAuthLetter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereBranchShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereBrandLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereBrandName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereBusinessCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereCategoryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereCityCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereContactName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereContactNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereDistrictCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereLicence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereMainImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereMainShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereOtherAuthorization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereProvinceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SelfServiceShop whereUserId($value)
 * @mixin \Eloquent
 */
class SelfServiceShop extends Model
{
    //
    protected $fillable = [
        'store_id', 'shop_id','contact_name','category_name','user_id', 'brand_name', 'brand_logo', "main_shop_name", "branch_shop_name"
        , "province_code", "city_code", "district_code", "address", "contact_number", "main_image", "audit_images1", "audit_images2", "audit_images3",
        "licence", "business_certificate",
        "auth_letter", "other_authorization"
    ];
}
