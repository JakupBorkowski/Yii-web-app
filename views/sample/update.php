<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sample */

$this->title = 'Update Sample: ' . $model->idSample;
$this->params['breadcrumbs'][] = ['label' => 'Samples', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idSample, 'url' => ['view', 'idSample' => $model->idSample]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sample-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
