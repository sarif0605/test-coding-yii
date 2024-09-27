<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-register">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Silakan isi kolom di bawah ini untuk mendaftar:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'register-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email')->input('email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <div class="form-group">
                <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
