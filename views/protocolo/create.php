<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Protocolo */
/* @var $modelUpload app\models\UploadForm */

$this->title = Yii::t('app', 'Adicionar Protocolo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Protocolos'), 'url' => ['meus-protocolos/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default" style="padding: 2%;">

    <div class="table-responsive">
        <?=
        $this->render('_form', [
            'model' => $model,
            'modelUpload' => $modelUpload,
        ])
        ?>
    </div>

</div>
