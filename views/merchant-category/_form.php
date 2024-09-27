<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MerchantCategoriy $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="merchant-categoriy-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'merchant_id')->textInput() ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
