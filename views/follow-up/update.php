<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FollowUp */

$this->title = Yii::t('app', 'Atualizar Follow-up: ', [
            'modelClass' => 'Follow Up',
        ]) . $model->id_follow_up;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Follow Ups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_follow_up, 'url' => ['view', 'id' => $model->id_follow_up]];
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
