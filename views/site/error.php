<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="panel panel-default" style="padding: 2%;">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Ocorreu um erro ao tentar utilizar essa funcionalidade, provavelmente você não possui as permissões requeridas.
        Verifique o seu nível de acesso no sistema e caso o problema persista contate o administrador do sistema.
    </p>
    <p>
        <a href="<?= $classe;?>" class="btn btn-default">Retornar</a>
    </p>

</div>
