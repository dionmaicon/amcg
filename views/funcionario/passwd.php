<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\Session;

$session = new Session();
$session->open();

$this->title = "Sistema de Protocolos - AMCG : Alteração de Senha ";
$this->params['breadcrumbs'][] = substr($this->title,30);


?>

<div class="panel panel-default" style="padding:1%">

    <div class="usuario-password-form">

        <?php
        $id = Yii::$app->user->id;
        $usuario = \app\models\Funcionario::findOne(['id_funcionario'=>$id]);

        ?>

        <h2>
            Mude sua senha
        </h2>

        <p> Proteja sua conta com uma senha forte!</p>


        <?php
        $form = ActiveForm::begin(['id' => 'usuario-password-form']);
        ?>

        <?= $form->field($model, 'old_password')->passwordInput()->label('Senha atual')?>

        <?= $form->field($model, 'new_password')->passwordInput()->label('Nova senha')?>

        <?= $form->field($model, 'repeat_password')->passwordInput()->label('Confirme a nova senha')?>

        <div class="form-group">
            <?= Html::submitButton( Yii::t('app', 'Enviar'), ['class' =>'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>