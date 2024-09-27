<?php

use app\models\MerchantCategoriy;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\MerchantCategoriySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Merchant Categoriys';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchant-categoriy-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Merchant Categoriy', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'merchant_id',
            'category_id',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, MerchantCategoriy $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'merchant_id' => $model->merchant_id, 'category_id' => $model->category_id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
