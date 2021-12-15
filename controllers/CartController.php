<?php

namespace app\controllers;

use app\models\Coupon;
use app\service\CartService;
use app\models\Products;
use app\service\CouponService;
use Yii;

class CartController extends \yii\web\Controller
{
    public function actionIndex() 
    { 
        $cartService = new CartService();
        
        $cart = $cartService->format();

        return $this->render('index', [
            'cart' => $cart,
        ]);
    }
   
    public function actionAddtocart($id) 
    {
        $cartService = new CartService();
 
        $product = Products::findOne($id);
        if($product)
        {
            $cartService->set($product->attributes);
            Yii::$app->session->setFlash('success', $product->attributes['name'] . " added!");
            return $this->redirect(['products/index']);
        }
    }
    public function actionUnsetcoupon()
    {
        $couponService = new CouponService();
        $couponService->unset();
        Yii::$app->session->setFlash('success', "coupon unset!");
        return $this->redirect(['cart/index']);
    }

    public function actionUnsetcart()
    {
        $cartService = new CartService();
        $cartService->unset();
        Yii::$app->session->setFlash('success', "cart unset!");
        return $this->redirect(['cart/index']);
    }

    public function actionCoupon()
    {
        $data = Yii::$app->request->post();
        $couponService = new CouponService();
        $couponModel = Coupon::findAll(['coupon_name' => $data['coupon']]);
        if(is_null($couponService->get())) 
        {
                if($couponModel)
                {
                    if(Coupon::validateCoupon($couponModel))
                
                    {
                        return json_encode(
                            [
                                'msg' => 'coupon accepted',
                                'status' => 1
                            ]
                        );
                    }
                    return json_encode(
                        [
                            'msg' => 'coupon has expired',
                            'status' => 0
                        ]
                    );

                }

                return json_encode(
                    [
                        'msg' => 'non-existent coupon',
                        'status' => 0
                    ]
                );
            
        } else {
            return json_encode(
                [
                    'msg' => 'a coupon is already in use',
                    'status' => 0
                ]
            );
        }
    }

}
