<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\QrCodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'QR Code Generati';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qr-code-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Genera QR Code', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'qr_code_id',
            'string_code',
            // 'published_artwork_id',

            ['class' => 'yii\grid\QRActionColumn'],
        ],
    ]); ?>
</div>
