<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FollowUp */

$this->title = "Follow-up " . $model->id_follow_up;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Follow Ups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default" style="padding: 2%;">

    <p>
        <?= Html::a(Yii::t('app', 'Atualizar'), ['update', 'id' => $model->id_follow_up], ['class' => 'btn btn-primary']) ?>

    </p>

    <div class="table-responsive">
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id_follow_up',
                'follow_up',
                'data_ultima_atualizacao',
                [                      // the owner name of the model
                    'label' => 'Autor',
                    'value' => function(\app\models\FollowUp $model){
                        return \app\models\Funcionario::findOne(['id_funcionario'=>$model->id_funcionario])->nome;
                    },
                ],
                'id_protocolo',
            ],
        ])
        ?>
    </div>

</div>
