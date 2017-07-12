<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProtocoloSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="protocolo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_protocolo') ?>

    <?= $form->field($model, 'descricao') ?>

    <?= $form->field($model, 'cpf') ?>

    <?= $form->field($model, 'cnpj') ?>

    <?= $form->field($model, 'responsavel') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'telefone') ?>

    <?php // echo $form->field($model, 'prioridade') ?>

    <?php // echo $form->field($model, 'titulo') ?>

    <?php // echo $form->field($model, 'data_abertura') ?>

    <?php // echo $form->field($model, 'data_ultima_atualizacao') ?>

    <?php // echo $form->field($model, 'data_fechamento') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'id_funcionario') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
