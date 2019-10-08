<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\PublishedArtwork;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\QrCode */
/* @var $form yii\widgets\ActiveForm */

$artworks = PublishedArtwork::find()->all();
$artworksNamesList = ArrayHelper::map($artworks, 'name', 'name');
?>

<div class="qr-code-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'name')->dropDownList($artworksNamesList, [
        'prompt' => "--seleziona l'opera d'arte--",
        'onchange' => '$.post( "index.php?r=published-artwork/list&name='.'"+$(this).val(), function( data ) {'
        . '$( "select#qrcode-string_code" ).html( data );'
        . '});'
        . '$.post( "index.php?r=published-artwork/id&name='.'"+$(this).val(), function( data ) {'
        . '$( "select#qrcode-published_artwork_id" ).html( data );'
        . '});',
    ]); ?>
    
    <?= $form->field($model, 'string_code')->dropDownList(['prompt' => '--stringa generata--',]); ?>
    
    <?= $form->field($model, 'published_artwork_id')->dropDownList(['prompt' => "--identificativo dell'opera generata--",]); ?>

    <div class="form-group">
        <?= Html::submitButton('Genera QR Code', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
