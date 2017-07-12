<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MeusProtocolos */

$this->title = "Protocolo ".$model->id_protocolo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Protocolos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default" style="padding: 2%;">

    <div class="row">
        <div class="col-md-2">
        <?= Html::a(Yii::t('app', 'Detalhar'), ['/protocolo/view', 'id' => $model->id_protocolo], 
                    ['class' => 'btn btn-primary','style'=> 'width:100%;margin-bottom: 2%;'])?>
        </div>
        <div class="col-md-2">
        <?= Html::a(Yii::t('app', 'Atualizar'), ['/protocolo/update', 'id' => $model->id_protocolo], 
                ['class' => 'btn btn-primary','style'=> 'width:100%;margin-bottom: 2%;']) ?>
        </div>
        <div class="col-md-2">
        <?= Html::a(Yii::t('app', 'Adicionar Follow Up'),['/follow-up/create', 'id_protocolo' => $model->id_protocolo], 
                ['class' => 'btn btn-primary','style'=> 'width:100%;margin-bottom: 2%;']) ?>
        </div>
        <div class="col-md-2">
        <?= Html::a(Yii::t('app', 'Atribuir Departamento'), ['/meus-protocolos/create', 'id_protocolo' => $model->id_protocolo], 
                ['class' => 'btn btn-primary','style'=> 'width:100%;margin-bottom: 2%;']) ?>
        </div>
        <div class="col-md-2">
            <?= Html::a(Yii::t('app', 'Anexar Arquivo'), ['/anexo/upload', 'id_protocolo' => $model->id_protocolo],
                ['class' => 'btn btn-primary', 'id'=>'modalButton','style'=> 'width:100%;margin-bottom: 2%;']) ?>
        </div>

    </div>


    <div class="table-responsive">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'label'=> 'Nº Protocolo',
                    'value'=> $model->id_protocolo,
                ],

                [
                    'label'=> 'Atribuido em',
                    'value'=>$model->data_atribuicao,
                ],
                [
                        'label'=> 'Departamento',
                        'value'=> function(\app\models\MeusProtocolos $model){
                            return \app\models\Departamento::findOne(['id_departamento'=>$model->id_departamento])->departamento;
                        },
                ],
                [                      // the owner name of the model
                    'label' => 'Título',
                    'value' => function(\app\models\MeusProtocolos $model){
                        return \app\models\Protocolo::findOne(['id_protocolo'=>$model->id_protocolo])->titulo;
                    },
                ],
    //            [                      // the owner name of the model
    //                'label' => 'Descrição',
    //                'value' => function(\app\models\MeusProtocolos $model){
    //                    return \app\models\Protocolo::findOne(['id_protocolo'=>$model->id_protocolo])->descricao;
    //                },
    //            ],
                [                      // the owner name of the model
                    'label' => 'Status',
                    'value' => function(\app\models\MeusProtocolos $model){
                        return \app\models\Protocolo::findOne(['id_protocolo'=>$model->id_protocolo])->status;
                    },
                ],
    //            [                      // the owner name of the model
    //                'label' => 'Últimos Follow Ups',
    //                'value' => $fls_s,
    //            ],

            ],
        ]) ?>
    </div>
    <?php
    $fls = \app\models\FollowUp::findAll( ['id_protocolo'=> $model->id_protocolo]);
    //print_r($fls);
    /* @var $fls app\models\FollowUp */
    $fls_s = '';
    foreach ($fls as $fl){
        $fls_s = $fls_s. $fl->follow_up ."<br>";
    }

    ?>
    
    <label for="folls"> Últimos Follow Ups: </label>
    <p> <?= $fls_s ?></p>

    <?php
    $protocolos = \app\models\MeusProtocolos::findAll( ['id_protocolo'=> $model->id_protocolo]);
    //print_r($fls);
    /* @var $deps app\models\MeusProtocolos */
    $deps_s = '';
    foreach ($protocolos as $protocolo_c){
        $deps_s = $deps_s. \app\models\Departamento::findOne(['id_departamento'=>$protocolo_c->id_departamento])->departamento.'<br>';
    }

    ?>
    <label for="folls">Departamentos Responsáveis: </label>
    <p> <?= $deps_s ?></p>

    <label for="folls">Anexos: </label>

    <?php
    $anexos = \app\models\Anexo::findAll( ['id_protocolo'=> $model->id_protocolo]);
    //print_r($fls);
    /* @var $anexo app\models\Anexo */

    foreach ($anexos as $anexo){

        $nome = explode('/', $anexo->caminho);
        echo '<div class="col-md-2>"';
        echo "<p>".$nome[3] ."<br>";
        echo Html::a(Yii::t('app', 'Download'), ['download', 'caminho' => $anexo->caminho],
        ['class' => 'btn btn-primary', 'id'=>$nome[1],'style'=> 'width:10%;margin-bottom: 2%;']);

        echo Html::a(Yii::t('app', 'Deletar'), ['remove', 'caminho' => $anexo->caminho,'id_atr'=>$model->id_atribuicao],
            ['class' => 'btn btn-danger', 'id'=>$nome[1],'style'=> 'width:10%;margin-bottom: 2%;']);
        echo "</p>";
        echo '</div>';
    }

    ?>


</div>
