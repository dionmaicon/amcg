<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Últimos Follow Ups');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default" style="padding: 2%;">

    <div class="table-responsive">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                    /*['class' => 'yii\grid\SerialColumn'],*/
                //'id_follow_up',
                'follow_up',
                'data_ultima_atualizacao',
                [                  // the owner name of the model
                    'label' => 'Autor',
                    'value' => function(\app\models\FollowUp $followUp) {
                        return ' '. \app\models\Funcionario::findOne(['id_funcionario'=> $followUp->id_funcionario])->nome;
                    }
                ],
                'id_protocolo',

                    ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        ?>
    </div>
</div>
