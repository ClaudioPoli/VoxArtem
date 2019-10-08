<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\PublishedArtwork */

$this->title = 'Modifica Opera Pubblicata: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Opere Pubblicate', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->published_artwork_id]];
$this->params['breadcrumbs'][] = 'Modifica';
?>
<div class="published-artwork-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
