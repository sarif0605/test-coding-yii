<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Categoriy $model */

$this->title = 'Update Categoriy: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categoriys', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="categoriy-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
