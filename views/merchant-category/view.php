<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\MerchantCategoriy $model */

$this->title = $model->merchant_id;
$this->params['breadcrumbs'][] = ['label' => 'Merchant Categoriys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="merchant-categoriy-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'merchant_id' => $model->merchant_id, 'category_id' => $model->category_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'merchant_id' => $model->merchant_id, 'category_id' => $model->category_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'merchant_id',
            'category_id',
        ],
    ]) ?>

</div>
