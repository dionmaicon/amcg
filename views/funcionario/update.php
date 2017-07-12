<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Funcionario */
/* @var $modelPass app\models\PasswordForm */

$this->title = Yii::t('app', 'Atualizar Funcionário: ', [
            'modelClass' => 'Funcionario',
        ]) . $model->id_funcionario;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Funcionarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_funcionario, 'url' => ['view', 'id' => $model->id_funcionario]];
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
