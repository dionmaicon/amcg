<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FollowUp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="follow-up-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_protocolo')->textInput(['readonly'=>true])->label('Nº Protocolo') ?>

    <?= $form->field($model, 'follow_up')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Adicionar') : Yii::t('app', 'Atualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
