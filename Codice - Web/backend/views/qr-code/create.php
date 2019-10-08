<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\QrCode */

$this->title = 'Genera QR Code';
$this->params['breadcrumbs'][] = ['label' => 'Genera QR Code', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qr-code-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
