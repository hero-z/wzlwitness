<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PufaStores
 *
 * @property int $id
 * @property string $store_id 商户号，服务商生成的，浦发命名规则：f年月日+随机数mt_rand(10000,99999)
 * @property string $merchant_id 商户号，浦发生成
 * @property string $merchant_pwd 浦发生成的商户秘钥，32位
 * @property int $pid 分店标识
 * @property string $store_name 商铺名称
 * @property float $rate 商铺费率设置
 * @property int $pay_status 付款码是否可用 1不可用，2 可用
 * @property string $fee_type 交易币种
 * @property int $mch_deal_type 商户经营类型，1实体，2虚拟
 * @property string $remark 备注
 * @property string $merchant_short_name 商铺简称
 * @property string $industr_id 行业类别，关联表pufa_shop_categories
 * @property string $province 商铺所在省份 关联表pufa_areas
 * @property string $city 商铺所在城市 关联表pufa_areas
 * @property string $address 商铺所在地址
 * @property string $tel 商铺店主手机号码
 * @property string $email 商铺店主邮箱
 * @property string $shop_user 商铺店主
 * @property string $id_code 负责人身份证号码
 * @property string $indentity_photo_a 法人身份证正面照片
 * @property string $indentity_photo_b 法人身份证背面照片
 * @property string $license_photo 法人身份证背面照片
 * @property string $bank_id 开户行，关联pufa_banks
 * @property string $account_code 银行卡号
 * @property int $account_type 持卡人证件类型，1企业，2个人
 * @property string $bank_name 开户支行名称
 * @property string $bank_tel 持卡人预留手机号码
 * @property string $contact_line 联行号，关联pufa_bank_relations
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int|null $user_id
 * @property string|null $user_name
 * @property string $indentity_photo_c 手持身份证照片
 * @property int $is_delete
 * @property string $district 省市区的区编号
 * @property string $license_no 营业执照编号
 * @property int $ch_pay_auth
 * @property string|null $wx_app_id
 * @property string|null $wx_secret
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereAccountCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereAccountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereBankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereBankTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereChPayAuth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereContactLine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereFeeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereIdCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereIndentityPhotoA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereIndentityPhotoB($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereIndentityPhotoC($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereIndustrId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereIsDelete($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereLicenseNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereLicensePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereMchDealType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereMerchantPwd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereMerchantShortName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores wherePayStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores wherePid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereShopUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereStoreId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereStoreName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereTel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereUserName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereWxAppId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PufaStores whereWxSecret($value)
 * @mixin \Eloquent
 */
class PufaStores extends Model
{
    //
    // protected $fillable = [    ];
}
