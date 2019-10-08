<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Artwork;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\PublishedArtwork */
/* @var $form yii\widgets\ActiveForm */

$artworks = Artwork::find()->all();
$artworksNamesList = ArrayHelper::map($artworks, 'name', 'name');
?>

<div class="published-artwork-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->dropDownList($artworksNamesList, [
        'prompt' => "--seleziona l'opera d'arte--",
        'onchange' => '$.post( "index.php?r=artwork/list&name='.'"+$(this).val(), function( data ) {'
        . '$( "select#publishedartwork-description" ).html( data );'
        . '});'
        . '$.post( "index.php?r=artwork/audio&name='.'"+$(this).val(), function( data ) {'
        . '$( "select#publishedartwork-audio" ).html( data );'
        . '});'
        . '$.post( "index.php?r=artwork/video&name='.'"+$(this).val(), function( data ) {'
        . '$( "select#publishedartwork-video" ).html( data );'
        . '});'
        . '$.post( "index.php?r=artwork/id&name='.'"+$(this).val(), function( data ) {'
        . '$( "select#publishedartwork-artwork_id" ).html( data );'
        . '});',
    ]); ?>
    
    <?= $form->field($model, 'description')->dropDownList(['prompt' => '--seleziona descrizione--']); ?>
    
    <?= $form->field($model, 'audio')->dropDownList(['prompt' => '--seleziona audio--',]); ?>
    
    <?= $form->field($model, 'video')->dropDownList(['prompt' => '--seleziona video--',]); ?>

    <?= $form->field($model, 'artwork_id')->dropDownList(['prompt' => "--seleziona identificativo dell'opera--",]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Pubblica' : 'Modifica', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
