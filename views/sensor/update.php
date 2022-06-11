<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sensor */

$this->title = 'Update Sensor: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sensors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'idSensor' => $model->idSensor]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sensor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
