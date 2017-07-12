
<?php
    use yii\widgets\Breadcrumbs;
    use dmstr\widgets\Alert;
?>

<div class="content-wrapper"  style="background: #E8E8E8;">

    <section class="content-header">
        <?php if (isset($this->blocks['content-header'])) { ?>
            <h1><?= $this->blocks['content-header'] ?></h1>
        <?php } else { ?>
            <h1>
                <?php
                if ($this->title !== null) {
                    echo \yii\helpers\Html::encode(ucfirst($this->title));
                } else {
                    echo \yii\helpers\Inflector::camel2words(
                        \yii\helpers\Inflector::id2camel($this->context->module->id)
                    );
                    echo ($this->context->module->id !== \Yii::$app->id) ? '<small>Module</small>' : '';
                } ?>
            </h1>
        <?php } ?>

        <?=
        Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
    </section>

    <section class="content">
        <?= Alert::widget() ?>
        <?= $content ?>
    </section>
</div>

<footer class="main-footer" style="clear:both;">
    <div class="pull-right hidden-xs">
        <b>Versão</b> 1.0
    </div>
    <strong>Copyright &copy; <?= date("Y");?> AMCG - Ponta Grossa</a>.</strong> Todos os direitos reservados.<br>
    CNPJ: 
</footer>

<div class='control-sidebar-bg'></div>