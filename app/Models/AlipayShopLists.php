<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AlipayShopLists
 *
 * @property int $id
 * @property int $pid
 * @property string $store_id
 * @property string|null $shop_id
 * @property int|null $user_id
 * @property string|null $apply_id
 * @property string|null $audit_status
 * @property string $app_auth_token
 * @property string $category_id
 * @property string $brand_name
 * @property string $brand_logo
 * @property string $main_shop_name
 * @property string $branch_shop_name
 * @property string $province_code
 * @property string $city_code
 * @property string $district_code
 * @property string $address
 * @property float $longitude
 * @property string $latitude
 * @property string $contact_number
 * @property string $notify_mobile
 * @property string $main_image
 * @property string $audit_images
 * @property string $business_time
 * @property string $wifi
 * @property string $parking
 * @property string $value_added
 * @property string $avg_price
 * @property string $isv_uid
 * @property string $licence
 * @property string $licence_code
 * @property string $licence_name
 * @property string $business_certificate
 * @property string $business_certificate_expires
 * @property string $auth_letter
 * @property string $is_operating_online
 * @property string $online_url
 * @property string $operate_notify_url
 * @property string $implement_id
 * @property string $no_smoking
 * @property string $box
 * @property string $request_id
 * @property string $other_authorization
 * @property string $licence_expires
 * @property string $op_role
 * @property string $biz_version
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int $is_delete
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereAppAuthToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereApplyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereAuditImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereAuditStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereAuthLetter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereAvgPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereBizVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereBox($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereBranchShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereBrandLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereBrandName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereBusinessCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereBusinessCertificateExpires($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereBusinessTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereCityCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereContactNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereDistrictCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereImplementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereIsDelete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereIsOperatingOnline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereIsvUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereLicence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereLicenceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereLicenceExpires($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereLicenceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereMainImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereMainShopName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereNoSmoking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereNotifyMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereOnlineUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereOpRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereOperateNotifyUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereOtherAuthorization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereParking($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists wherePid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereProvinceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereShopId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereValueAdded($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AlipayShopLists whereWifi($value)
 * @mixin \Eloquent
 */
class AlipayShopLists extends Model
{
    //
    protected $fillable = ['store_id',"pid",'is_delete','audit_status','apply_id','shop_id','app_auth_token','category_id', 'brand_name', 'brand_logo', "main_shop_name", "branch_shop_name"
        ,"province_code","city_code","district_code","address","longitude","latitude","contact_number","notify_mobile","main_image","audit_images","business_time",
    "wifi","parking","value_added","avg_price","isv_uid","licence","licence_code","licence_name","business_certificate","business_certificate_expires",
        "auth_letter","is_operating_online","online_url","operate_notify_url","implement_id","no_smoking",
        "box","user_id","request_id","other_authorization","licence_expires","op_role","biz_version"
    ];
}
