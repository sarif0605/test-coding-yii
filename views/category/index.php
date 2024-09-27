<?php

use app\models\Categoriy;
use yii\helpers\Html;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\CategoriySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Categoriys';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoriy-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->identity->role === 'admin'): ?> <!-- Cek role pengguna -->
        <p>
            <?= Html::a('Create Categoriy', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php Pjax::begin(); ?>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <?php foreach ($dataProvider->models as $model): ?>
            <div class="bg-white rounded-lg shadow-md p-4">
                <h2 class="text-lg font-semibold"><?= Html::encode($model->name) ?></h2>
                <p><strong>ID:</strong> <?= Html::encode($model->id) ?></p>
                <p><strong>Description:</strong> <?= Html::encode($model->description) ?></p>

                <div class="mt-2">
                    <?= Html::a('View', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?php if (Yii::$app->user->identity->role === 'admin'): ?>
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
