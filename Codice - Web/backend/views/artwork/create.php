<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Artwork */

$this->title = 'Aggiungi Opera';
$this->params['breadcrumbs'][] = ['label' => 'Opere', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artwork-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
