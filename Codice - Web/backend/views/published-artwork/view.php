<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\PublishedArtwork */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Opere Pubblicate', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="published-artwork-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modifica', ['update', 'id' => $model->published_artwork_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Elimina', ['delete', 'id' => $model->published_artwork_id], [
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
            'published_artwork_id',
            'name',
            'description',
            'audio',
            'video',
            'artwork_id',
        ],
    ]) ?>

</div>
