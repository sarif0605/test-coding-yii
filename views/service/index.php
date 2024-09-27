<?php

use app\models\Service;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\ServiceSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->identity->role === 'admin'): ?> <!-- Cek role pengguna -->
        <p>
            <?= Html::a('Create Service', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <?php foreach ($dataProvider->getModels() as $model): ?>
            <div class="col-md-4">
                <div class="card mb-4" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?= Html::encode($model->name) ?></h5>
                        <p class="card-text"><?= Html::encode($model->description) ?></p>
                        <p class="card-text"><?= Html::encode($model->merchant->name) ?></p>
                        <p class="card-text"><strong>Price:</strong> <?= Yii::$app->formatter->asCurrency($model->price) ?></p>
                        <a href="<?= Url::to(['view', 'id' => $model->id]) ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php Pjax::end(); ?>
</div>
