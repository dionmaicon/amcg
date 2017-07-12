<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Protocolos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default" style="padding: 2%;">
   

    <p>
        <?= Html::a(Yii::t('app', 'Adicionar Protocolo'), ['/protocolo/create'], ['class' => 'btn btn-primary']) ?>
    </p>
    
    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],


                [                  // the owner name of the model
                    'label' => 'Departamento',
                    'value' => function(\app\models\MeusProtocolos $protocolo) {
                        return ' '. \app\models\Departamento::findOne(['id_departamento'=> $protocolo->id_departamento])->departamento;
                    }
                ],
                [                  // the owner name of the model
                    'label' => 'Protocolo',
                    'value' => function(\app\models\MeusProtocolos $protocolo) {
                        return ' '. \app\models\Protocolo::findOne(['id_protocolo'=> $protocolo->id_protocolo])->titulo;
                    }
                ],
                [                  // the owner name of the model
                    'label' => 'Código do Cliente',
                    'value' => function(\app\models\MeusProtocolos $protocolo) {
                        return ' '. \app\models\Protocolo::findOne(['id_protocolo'=> $protocolo->id_protocolo])->codigo_busca;
                    }
                ],
                [                  // the owner name of the model
                    'label' => 'Solicitante',
                    'value' => function(\app\models\MeusProtocolos $protocolo) {
                        return ' '. \app\models\Protocolo::findOne(['id_protocolo'=> $protocolo->id_protocolo])->responsavel;
                    }
                ],
//                [                  // the owner name of the model
//                    'label' => 'Responsável',
//                    'value' => function(\app\models\MeusProtocolos $protocolo) {
//                        return ' '. \app\models\Protocolo::findOne(['id_protocolo'=> $protocolo->id_protocolo])->idFuncionario->nome;
//                    }
//                ],
                [                  // the owner name of the model
                    'label' => 'Status',
                    'value' => function(\app\models\MeusProtocolos $protocolo) {
                        return ' '. \app\models\Protocolo::findOne(['id_protocolo'=> $protocolo->id_protocolo])->status;
                    }
                ],

                'data_atribuicao',

                ['class' => 'yii\grid\ActionColumn','template' => '{view}'],
            ],
        ]); ?>
    </div>
</div>

