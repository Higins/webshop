<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Coupon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="coupon-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'coupon_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coupon_discount')->textInput() ?>

    <?= $form->field($model, 'valid')->textInput() ?>

    <?= $form->field($model, 'valid_from')->textInput() ?>

    <?= $form->field($model, 'valid_to')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
