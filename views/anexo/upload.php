<?php
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']],
    ['id'=>$model->formName()]) ?>

<?= $form->field($model, 'inputFile')->fileInput() ?>

    <button>Submit</button>

<?php ActiveForm::end() ?>

