<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PublishedArtwork */

$this->title = 'Pubblica Opera';
$this->params['breadcrumbs'][] = ['label' => 'Opere Pubblicate', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="published-artwork-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
