<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\QrCodeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qr-code-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'qr_code_id') ?>

    <?= $form->field($model, 'string_code') ?>

    <?= $form->field($model, 'published_artwork_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Cerca', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
