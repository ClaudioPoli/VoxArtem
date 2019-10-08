<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Museum */

$this->title = 'Aggiungi Museo';
$this->params['breadcrumbs'][] = ['label' => 'Musei', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="museum-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
