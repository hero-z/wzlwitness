<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UnionPayConfig
 *
 * @property int $id
 * @property string|null $app_id
 * @property string|null $acquirer_id
 * @property string|null $rsa_private_key
 * @property string|null $union_public_key
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UnionPayConfig whereAcquirerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UnionPayConfig whereAppId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UnionPayConfig whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UnionPayConfig whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UnionPayConfig whereRsaPrivateKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UnionPayConfig whereUnionPublicKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UnionPayConfig whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class UnionPayConfig extends Model
{
    //
}
