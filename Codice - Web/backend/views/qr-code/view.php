<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\QrCode */

$this->title = $model->qr_code_id;
$this->params['breadcrumbs'][] = ['label' => 'Genera QR Code', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qr-code-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Elimina', ['delete', 'id' => $model->qr_code_id], [
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
            'qr_code_id',
            'string_code',
            'published_artwork_id',
        ],
    ]) ?>
    
    <?php echo "<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=".urlencode($model->string_code)."&choe=UTF-8' title='QR Code'/>" ?>

</div>
