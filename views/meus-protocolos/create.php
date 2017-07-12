<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MeusProtocolos */

$this->title = Yii::t('app', 'Atribuir Protocolo a Departamento');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Meus Protocolos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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


