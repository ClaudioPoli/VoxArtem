<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Museum;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Artwork */
/* @var $form yii\widgets\ActiveForm */
$museums = Museum::find()->all();
$museumsNamesList = ArrayHelper::map($museums, 'name', 'name');
?>

<div class="artwork-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'long_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'media')->widget(FileInput::classname(), []); ?>

    <?= $form->field($model, 'museum_name')->dropDownList($museumsNamesList, [
        'prompt' => '--seleziona il museo di appartenenza--',
        'onchange' => '$.post( "index.php?r=museum/list&name='.'"+$(this).val(), function( data ) {'
        . '$( "select#artwork-museum_id" ).html( data );'
        . '});',
    ]); ?>
    
    <?= $form->field($model, 'museum_id')->dropDownList(['prompt' => '--seleziona identificativo del museo--']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Aggiungi' : 'Modifica', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
