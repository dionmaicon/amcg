<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MeusProtocolos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meus-protocolos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_protocolo')->textInput(['readonly'=>true])->label('Nº Protocolo') ?>
    <?= $form->field($model, 'id_departamento')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Departamento::find()->where('id_departamento <> '.$model->id_departamento)->all(),'id_departamento','departamento'))->label("Selecione um departamento:")?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Adicionar') : Yii::t('app', 'Atualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
