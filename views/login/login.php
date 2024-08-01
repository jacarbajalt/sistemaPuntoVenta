<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Login';
?>
<link rel="stylesheet" type="text/css" href="css/login.css">
<div class="login-container">
    
    <div class="card">
        <div class="card-body p-5">
            <div class="text-center mb-4">
                <h2>Inicie Sesión con su Cuenta</h2>
            </div>

            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{input}\n{error}",
                    'labelOptions' => ['class' => 'col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'form-control form-control-lg'],
                    'errorOptions' => ['class' => 'invalid-feedback'],
                ],
            ]); ?>

            <div class="form-group mb-3">
                <?= $form->field($model, 'username')->textInput([
                    'autofocus' => true,
                    'placeholder' => 'Usuario',
                ])->label(false) ?>
            </div>

            <div class="form-group mb-4">
                <?= $form->field($model, 'password')->passwordInput([
                    'placeholder' => 'Clave',
                ])->label(false) ?>
            </div>

            <div class="form-group text-center">
                <?= Html::submitButton('Log in', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

