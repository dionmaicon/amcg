<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Follow_upSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="follow-up-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_follow_up') ?>

    <?= $form->field($model, 'follow_up') ?>

    <?= $form->field($model, 'data_ultima_atualizacao') ?>

    <?= $form->field($model, 'id_protocolo') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
