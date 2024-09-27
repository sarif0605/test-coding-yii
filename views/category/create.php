<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Categoriy $model */

$this->title = 'Create Categoriy';
$this->params['breadcrumbs'][] = ['label' => 'Categoriys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoriy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
