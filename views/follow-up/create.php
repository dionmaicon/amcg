<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FollowUp */

$this->title = Yii::t('app', 'Adicionar Follow Up');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Follow Ups'), 'url' => ['index']];
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
