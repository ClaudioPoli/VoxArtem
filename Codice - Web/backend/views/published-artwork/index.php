<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PublishedArtworkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Opere Pubblicate';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="published-artwork-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Pubblica Opera', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'published_artwork_id',
            'name',
            'description',
            // 'audio',
            // 'video',
            // 'artwork_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
