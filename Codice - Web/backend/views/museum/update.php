<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Museum */

$this->title = 'Modifica Museo: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Musei', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->museum_id]];
$this->params['breadcrumbs'][] = 'Aggiorna';
?>
<div class="museum-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
