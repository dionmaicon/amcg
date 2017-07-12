<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';

?>

<style type="text/css">
    .btn-login {
    background-color: #59B2E0;
    outline: none;
    color: #fff;
    font-size: 14px;
    height: auto;
    font-weight: normal;
    padding: 14px 0;
    text-transform: uppercase;
    border-color: #59B2E6;
}
.btn-login:hover,
.btn-login:focus {
    color: #fff;
    background-color: #53A3CD;
    border-color: #53A3CD;
}
.forgot-password {
    text-decoration: underline;
    color: #888;
}
.forgot-password:hover,
.forgot-password:focus {
    text-decoration: underline;
    color: #666;
}

.btn-register {
    background-color: #1CB94E;
    outline: none;
    color: #fff;
    font-size: 14px;
    height: auto;
    font-weight: normal;
    padding: 14px 0;
    text-transform: uppercase;
    border-color: #1CB94A;
}
.btn-register:hover,
.btn-register:focus {
    color: #fff;
    background-color: #1CA347;
    border-color: #1CA347;
}
</style>


<div class="container" style="margin: 5% auto;">

    <div class="row">

        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <a class="active" id="login-form-link">Login</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="/site" id="register-form-link">Voltar</a>
                        </div>
                    </div>
                    <hr>
                </div>

                <div class="panel-body">
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-for',
                        'action' => 'login',
                    ]); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-control', 'placeholder' => 'Usuário'])->label('')?>

                    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Senha'])->label('') ?>

                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "<div class=\"col-sm-6 col-sm-offset-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                        ])->label('Mantenha-me conectado')
                    ?>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <?= Html::submitButton('Login', ['class' => 'form-control btn btn-login', 'name' => 'login-button']) ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <a href="#" tabindex="5" class="forgot-password">Esqueceu a senha?</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>

            </div>
        </div>
    </div>
</div>
