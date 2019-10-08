<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Museum */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Musei', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="museum-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Modifica', ['update', 'id' => $model->museum_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Elimina', ['delete', 'id' => $model->museum_id], [
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
            'museum_id',
            'name',
            'address',
            'opening',
            'closing',
            'description',
            'video',
        ],
    ]) ?>

</div>
