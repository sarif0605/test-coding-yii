<?php

use app\models\Merchant;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\MerchantSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Merchants';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchant-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->identity->role === 'admin'): ?> <!-- Cek role pengguna -->
        <p>
            <?= Html::a('Create Merchant', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($dataProvider->models as $model): ?>
            <div class="bg-white rounded-lg shadow-md p-4">
                <h2 class="text-lg font-semibold"><?= Html::encode($model->name) ?></h2>
                <p><strong>Location:</strong> <?= Html::encode($model->location) ?></p>
                <p><strong>Category:</strong> <?= Html::encode($model->category) ?></p>
                <p><strong>Created At:</strong> <?= Html::encode($model->created_at) ?></p>

                <div class="mt-2">
                    <?= Html::a('View', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    
                    <?php if (Yii::$app->user->identity->role === 'admin'): ?> <!-- Cek role pengguna -->
                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php Pjax::end(); ?>
</div>
