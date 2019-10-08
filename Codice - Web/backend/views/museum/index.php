<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MuseumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Musei';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="museum-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Aggiungi Museo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'museum_id',
            'name',
            'address',
            'opening',
            'closing',
            // 'description',
            // 'video',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
