<?php

namespace app\service;
use yii;
use app\helper\Helpers;
use app\service\CouponService;

class CartService {

    private $cartItem = [];

    public function set($items) 
    {
        
        if(empty(Yii::$app->session->get('CartItems'))) {
            array_push($this->cartItem,$items);
            Yii::$app->session->set('CartItems', $this->cartItem);
        }else{
            array_push($_SESSION['CartItems'],$items);
        }
       
        
        
    }
    public function get()
    {
        return Yii::$app->session->get('CartItems');
    }

    public function unset()
    {
        Yii::$app->session->remove('CartItems');
    }

    public function format()
    {
        $couponService = new CouponService;
        $cartItems = $this->get();
        if($cartItems) 
        {
            $cartItemCount = count($cartItems);
            $cartItemUniqueCount = count(array_unique(array_column($cartItems, 'name'))); 
            $cartData = [];
            $cartDataQuantity = []; 
            $sumPrice = 0;
            $sumSpecialPrice = 0;
            foreach($cartItems as $cartItem) {
                
                    $cartData[$cartItem['id']]['name'] = $cartItem['name'];
                    $cartData[$cartItem['id']]['id'] = $cartItem['id'];
                    $cartData[$cartItem['id']]['price'] = $cartItem['price'];
                    $sumPrice += $cartItem['price'];
                    if($cartItem['onsale']) {
                        $sumPrice -= $cartItem['price'];
                        $sumSpecialPrice += $cartItem['special_price'];
                        $cartData[$cartItem['id']]['special_price'] = $cartItem['special_price'];
                    }
                    $cartData[$cartItem['id']]['onsale'] = $cartItem['onsale'];
                    $cartDataQuantity[]['id'] = $cartItem['id'];             
                
            }
            if(!is_null($couponService->get()) && !empty($couponService->get())) {
                $discount = ($sumPrice / 100) * $couponService->get();
                $sumPrice = $sumPrice - $discount;
            }
            $sumPrice = $sumSpecialPrice + $sumPrice;
           
            return [
                'cartItemCount' => $cartItemCount,
                'cartItemUniqCount' => $cartItemUniqueCount,
                'cartData' => $cartData,
                'quantityById' => Helpers::array_icount_values($cartDataQuantity),
                'sum' => $sumPrice
    
            ];
        }
      
    }

    public function getCartItemsNumber()
    {
        $cartItems = $this->get();
        if($cartItems) 
        {
            return count($cartItems);
        }
        return 0;
    }


    
}