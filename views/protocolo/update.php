<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Protocolo */

$this->title = Yii::t('app', 'Atualização de Protocolo - ID: ', [
    'modelClass' => 'Protocolo',
]) . $model->id_protocolo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Protocolos'), 'url' => ['meus-protocolos/index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_protocolo, 'url' => ['view', 'id' => $model->id_protocolo]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="panel panel-default" style="padding: 2%;">
    
    <?= $this->render('_form', [
        'model' => $model,
        'modelUpload'=> $modelUpload,
    ]) ?>

</div>
