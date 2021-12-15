<?php

namespace app\service;
use yii;

class CouponService {

    public function set($couponDiscount)
    {
        if(empty(Yii::$app->session->get('coupon'))) {
            Yii::$app->session->set('coupon', $couponDiscount);
        }
    }

    public function get()
    {
        return Yii::$app->session->get('coupon');
    }

    public function unset()
    {
        Yii::$app->session->remove('coupon');
    }


}