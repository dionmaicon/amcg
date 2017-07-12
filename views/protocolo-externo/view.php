<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Protocolo */

$this->title = "Protocolo ".$model->id_protocolo;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Protocolos'), 'url' => ['meus-protocolos/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default" style="padding: 2%;">
    
    <?php $form = \yii\widgets\ActiveForm::begin(); ?>
    
    <p>
        <?= Html::a(Yii::t('app', 'Atualizar'), ['update', 'id' => $model->id_protocolo], ['class' => 'btn btn-primary']) ?>

    </p>    

    <?= $form->field($model, 'descricao')->textarea()->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_protocolo',
            'codigo_busca',
            'cpf',
            'cnpj',
            'responsavel',
            'email:email',
            'telefone',
            'prioridade',
            'titulo',
            'data_abertura',
            'data_ultima_atualizacao',
            'data_fechamento',
            'status',
            'id_funcionario',
        ],
    ]) ?>
    
    <?php $form = \yii\widgets\ActiveForm::end(); ?>

</div>
