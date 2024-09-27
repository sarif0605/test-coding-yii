<?php

use app\models\Queue;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\QueueSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Queues';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="queue-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->identity->role === 'admin'): ?> <!-- Cek role pengguna -->
        <p>
            <?= Html::a('Create Queue', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php Pjax::begin(); ?>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <?php foreach ($dataProvider->models as $model): ?>
        <div class="bg-white rounded-lg shadow-md p-4">
            <h2 class="text-lg font-semibold">Service Name: <?= Html::encode($model->service->name) ?></h2>
            <p><strong>User Name:</strong> <?= Html::encode($model->user ? $model->user->username : 'Unknown User') ?></p>
            <p><strong>Merchant Name:</strong> <?= Html::encode($model->merchant ? $model->merchant->name : 'Unknown Merchant') ?></p>
            <p><strong>Merchant Location:</strong> <?= Html::encode($model->merchant ? $model->merchant->location : 'Unknown Merchant') ?></p>
            <p><strong>Queue Number:</strong> <?= Html::encode($model->queue_number) ?></p>
            <p><strong>Status:</strong> <?= Html::encode($model->queue_status) ?></p>

            <div class="mt-2">
                <?php if (Yii::$app->user->identity->role === 'admin'): ?> <!-- Cek role pengguna -->
                    <?= Html::a('View', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                <?php else: ?>
                    <?= Html::a('View', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    
    <?php Pjax::end(); ?>
</div>
