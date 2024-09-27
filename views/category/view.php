<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Categoriy $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categoriys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="categoriy-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->user->identity->role === 'admin'): ?> <!-- Cek role pengguna -->
        <div class="card mb-3 p-3">
            <div class="card-body">
                <p>
                    <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
                    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?>
                </p>
            </div>
        </div>
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
        ],
    ]) ?>

</div>
