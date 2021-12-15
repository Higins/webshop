<?php

namespace app\models;

use Yii;
use app\service\CouponService;

/**
 * This is the model class for table "coupon".
 *
 * @property int $id
 * @property string|null $coupon_name
 * @property int|null $coupon_discount
 * @property int|null $valid
 * @property string|null $valid_from
 * @property string|null $valid_to
 */
class Coupon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'coupon';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['coupon_discount', 'valid'], 'integer'],
            [['valid_from', 'valid_to'], 'safe'],
            [['coupon_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coupon_name' => 'Coupon Name',
            'coupon_discount' => 'Coupon Discount',
            'valid' => 'Valid',
            'valid_from' => 'Valid From',
            'valid_to' => 'Valid To',
        ];
    }

    public static function validateCoupon($couponModel)
    {
        $couponModel = $couponModel[0]->attributes;

        $nowDate = date('Y-m-d');
        if (($nowDate >= $couponModel["valid_from"]) && ($nowDate <= $couponModel["valid_to"])){
            $couponService = new CouponService();
            $couponService->set($couponModel['coupon_discount']);
            return true;
        }else{
           return false;

        }
    }
}
