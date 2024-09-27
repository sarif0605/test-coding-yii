<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MerchantCategoriy $model */

$this->title = 'Create Merchant Categoriy';
$this->params['breadcrumbs'][] = ['label' => 'Merchant Categoriys', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchant-categoriy-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
