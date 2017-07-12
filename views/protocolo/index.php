<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProtocoloSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Protocolos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default" style="padding: 2%;">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Novo Protocolo'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                /*['class' => 'yii\grid\SerialColumn'],*/

                'id_protocolo',
                'titulo',
                'cpf',
                'cnpj',
                'responsavel',
                // 'email:email',
                // 'telefone',
                // 'prioridade',
                // 'titulo',
                // 'data_abertura',
                // 'data_ultima_atualizacao',
                // 'data_fechamento',
                // 'status',
                // 'id_funcionario',

                ['class' => 'yii\grid\ActionColumn','template' => '{view}{update}'],
            ],
        ]); ?>
    </div>
</div>
