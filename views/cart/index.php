<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;



/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Cart';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cart-index">

    <h1><?= Html::encode($this->title) ?></h1>

   
            <?php
            if (!empty($cart)) {
            ?>
             <a href="<?= Url::to(['cart/unsetcart'], true); ?>" class="btn btn-danger">Unset cart</a>
            <?php
                foreach ($cart['cartData'] as $cartData) {                  
            ?>
    
            <div class="row" >
                        <div class="col-12 col-sm-12 col-md-2 text-center">
                                <img class="img-responsive" src="http://placehold.it/120x80" alt="prewiew" width="120" height="80">
                        </div>
                        <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                            <h4 class="product-name"><strong><?php echo $cartData['name'] ?></strong></h4>
                            <h4>
                                <small>Product description</small>
                            </h4>
                        </div>
                        
                        <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row" >
                            <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                    
                                <h6><strong><?php echo ($cartData['onsale'] == 0) ? $cartData['price'] : $cartData['special_price']  ?> <span class="text-muted">x</span></strong></h6>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4">
                                <div class="quantity">
                                             <?php

                                             echo $cart['quantityById'][$cartData['id']]; ?> DB            
                                </div>
                            </div>
                
                        </div>
                    </div>

            <?php
                } ?>
            
            <div class="card-footer">
                <div class="coupon col-md-5 col-sm-5 no-padding-left pull-left">
                    <div class="row">
                        <div id="couponinfo">

                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="cupone code" id="coupon">
                        </div>
                        <div class="col-6">
                            <input type="submit" class="btn btn-info" value="Use cupone" onclick="applyCoupon()">
                            <br>
                            <a href="<?= Url::to(['cart/unsetcoupon'], true); ?>" class="btn btn-danger">Unset coupon</a>
                        </div>
                    </div>
                </div>
                <div class="pull-right" style="margin: 10px">
                    <a href="" class="btn btn-success pull-right">Checkout</a>
                    <div class="pull-right" style="margin: 5px">
                        Total price: <b> <?php echo $cart['sum'] ?> €</b>
                    </div>
                    <div class="pull-right" style="margin: 5px">
                        Total items: <b><?php echo $cart['cartItemCount'] ?></b>
                    </div>
                </div>
            </div>
        </div>
        <?php
            } else  {?>
            Cart is empty
            <?php }?>

</div>
<script>
    function applyCoupon()
    {
        $.ajax({
       url: 'index.php?r=<?php echo Yii::$app->request->baseUrl. 'cart/coupon' ?>',
       type: 'post',
       data: {
                coupon: $("#coupon").val(),
                 _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
             },
       success: function (data) {
        var data = $.parseJSON(data); 
        var reload = false;
           if(data.status == 0) 
           {
            html = '<div class="alert alert-danger" role="alert">'+data.msg+'</div>';
           } else 
           {
            html = '<div class="alert alert-success" role="alert">'+data.msg+'</div>';
            reload = true;

           }
           $('#couponinfo').html(html);
           $('#couponinfo').fadeIn('fast').delay(4000).fadeOut('slow', function() {
                if(reload)
                {
                    location.reload();
                }
            });
           
       }
  });
    }
</script>