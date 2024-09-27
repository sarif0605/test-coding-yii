<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Queue $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="queue-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- Service Name (Read-only) -->
    <input type="text" class="form-control" value="<?= Html::encode($service->name) ?>" readonly>

    <!-- Optional: Additional fields for user notes or preferences -->

    <div class="form-group">
        <?= Html::submitButton('Dapatkan Nomor Antrian', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>