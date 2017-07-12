<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Funcionario */

$this->title = "Funcionário ".$model->id_funcionario;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Funcionarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default" style="padding: 2%;">

    <p>
        <?= Html::a(Yii::t('app', 'Atualizar'), ['update', 'id' => $model->id_funcionario], ['class' => 'btn btn-primary']) ?>

    </p>

    <div class="table-responsive">
        <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id_funcionario',
                'username',
                //'password',
                //'auth_key',
                //'token',
                'email:email',
                'nome',
                'cargo',
                //'acesso',
                'id_departamento',
            ],
        ])
        ?>
    </div>

</div>
