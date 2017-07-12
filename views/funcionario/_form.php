<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Funcionario */
/* @var $modelPass app\models\PasswordForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="funcionario-form">
    <?php
    $tipoAcesso = array(
        0 => 'Administrador',
        1 => 'Normal'
    );

    ?>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?php if($model->isNewRecord){ ?>
        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?php } ?>
    


    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cargo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'acesso')->textInput()
        ->dropDownList($tipoAcesso, array('prompt' => 'Selecione ...'))
        ->label('Qual o nível de acesso desejado?'); ?>

    <?= $form->field($model, 'id_departamento')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Departamento::find()->all(),'id_departamento','departamento'))->label("Departamento:") ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Adicionar') : Yii::t('app', 'Atualizar'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
