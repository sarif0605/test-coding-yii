<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MerchantCategoriy $model */

$this->title = 'Update Merchant Categoriy: ' . $model->merchant_id;
$this->params['breadcrumbs'][] = ['label' => 'Merchant Categoriys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->merchant_id, 'url' => ['view', 'merchant_id' => $model->merchant_id, 'category_id' => $model->category_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="merchant-categoriy-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
