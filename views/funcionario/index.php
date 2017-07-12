<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FuncionarioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Funcionarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default" style="padding: 2%;">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Adicionar Funcionario'), ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <div class="table-responsive">
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                   /* ['class' => 'yii\grid\SerialColumn'],*/
                //'id_funcionario',
                'username',
               // 'password',
                //'auth_key',
                //'token',
                // 'email:email',
                'nome',
                // 'cargo',
                // 'acesso',
                // 'id_departamento',
                ['class' => 'yii\grid\ActionColumn','template' => '{view} {update}'],
            ],
        ]);
        ?>
    </div>
</div>
