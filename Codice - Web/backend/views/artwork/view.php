<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Artwork */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Opere', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artwork-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modifica', ['update', 'id' => $model->artwork_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Elimina', ['delete', 'id' => $model->artwork_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Sei sicuro di voler eliminare questo elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'artwork_id',
            'name',
            'short_description',
            'long_description',
            'audio',
            'video',
            'museum_id',
        ],
    ]) ?>

</div>
