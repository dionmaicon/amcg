<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriasProdutosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorias Produtos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categorias-produtos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Categorias Produtos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_categoria',
            'categoria',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
