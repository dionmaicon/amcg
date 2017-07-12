<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MeusProtocolos */

$this->title = Yii::t('app', 'Atualizar protocolo: Nº', [
            'modelClass' => 'Meus Protocolos',
        ]) . $model->id_atribuicao;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Meus Protocolos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_atribuicao, 'url' => ['view', 'id' => $model->id_atribuicao]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="panel panel-default" style="padding: 2%;">

    <div class="table-responsive">
        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>
    </div>

</div>


