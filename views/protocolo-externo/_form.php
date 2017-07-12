<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Protocolo */
/* @var $form yii\widgets\ActiveForm */
/* @var $modelUpload app\models\UploadForm */
/* @var $modelAtribuicao app\models\MeusProtocolos */
?>

<?php $this->registerJs(<<<JS
    $('select[id=protocolo-tipo_pessoa]').on('change', function(){
    
   var value = $(this).val();

    if(value == 'f'){
        $('div[class=cpf]').show();
        $('div[class=cnpj]').hide();
        $('input[id=Protocolo_cnpj]').val('');
    } else if(value == 'j'){
        $('div[class=cnpj]').show();
        $('div[class=cpf]').hide();
        $('input[id=Protocolo_cpf]').val('');
    }
    });
JS
);
?>
<?php $this->registerJs(<<<JS
    $('.add_departamento').on('click', function(){
        var campos = $('.campos').eq(0).clone(); // copiar só um destes elementos, escolhi copiar o primeiro que é o unico que tenho a certeza que vai sempre existir
        campos.find('input').val(''); // por o valor dos inputs dos novos campos (nome/email) vazios para o caso de termos preenchido já nos primeiros inputs ($('.campos').eq(0))
        $('input[type="submit"]').before(campos);
    });
JS
);
?>

    <?php
        Modal::begin([
            'header'=>'<h4>Anexos<h4>',
            'id'=>'modal',
            'size'=>'modal-lg'
        ]);
        echo "<div id='modalContent'> </div>";

        Modal::end();
    ?>

<div class="protocolo-form">



    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textarea()->widget(\dosamigos\ckeditor\CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>


    <?= $form->field($model, 'responsavel')->textInput(['maxlength' => true]) ?>

    <?php
    $tipopessoa = array(
        'f' => 'Pessoa Física',
        'j' => 'Pessoa Jurídica'
    );

    $prioridade = array(
        'Baixa' => 'Baixa',
        'Média' => 'Média',
        'Alta' => 'Alta',
        'Urgente' => 'Urgente'
    );

    $status = array(
        'Novo'=>'Novo',
        'Pendente' => 'Pendente',
        'Solucionado' => 'Solucionado',
        'Atribuido' => 'Atribuido',
        'Fechado' => 'Fechado'
    );

    echo $form->field($model, 'tipo_pessoa')
        ->dropDownList($tipopessoa, array('prompt' => 'Selecione ...'))
        ->label('O solicitante é pessoa física ou jurídica?');
    ?>



    <div class="cpf" >
        <?= $form->field($model, 'cpf')->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '999.999.999-99',
        ])->hint('*Digite apenas números')
        ?>
    </div>

    <div class="cnpj" hidden="true" >
        <?= $form->field($model, 'cnpj')->textInput(['options' =>['type'=>'hidden']])->widget(\yii\widgets\MaskedInput::className(), [
            'mask' => '99.999.999/9999-99',
        ])->hint('*Digite apenas números')
        ?>

    </div>


    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefone')->textInput(['maxlength' => true])->hint('Ex: (054) 99900-0000')   ?>

    <?= $form->field($model, 'prioridade')->textInput(['maxlength' => true])
        ->dropDownList($prioridade, array('prompt' => 'Selecione a prioridade...'))
    ?>


    <?php

    if($model->isNewRecord == false){
        echo $form->field($model, 'status')->textInput(['maxlength' => true])
            ->dropDownList($status, array('prompt' => 'Selecione...'));

     }
    ?>

    <?= $form->field($model, 'id_funcionario')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Funcionario::find()->where('ativo is true ')->all(),'id_funcionario','nome'))->label("Selecione um responsável:")?>

    <!--<form method="POST">
        <p> Adicione os departamentos responsáveis por atender este protocolo. </p>
        <?php $departamento = new \app\models\Departamento()?>
        <div class="campos">
           <?= $form->field($departamento, 'id_departamento')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Departamento::find()->all(),'id_departamento','departamento'))->label("Departamento:")?> <button class="add_departamento">Adicionar</button>
        </div>
        <input type="submit">
    </form>-->

    <?= $form->field($modelUpload, 'inputFile')->fileInput()->label('Anexar Arquivo') ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Salvar') : Yii::t('app', 'Atualizar'), ['class' => $model->isNewRecord ? 'btn btn-primary' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
