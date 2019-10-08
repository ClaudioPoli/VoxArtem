<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ArtworkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Opere';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="artwork-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Aggiungi Opera', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'artwork_id',
            'name',
            'short_description',
            'long_description',
            // 'audio',
            // 'video',
            // 'museum_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
