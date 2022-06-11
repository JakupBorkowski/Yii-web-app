<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sensortype */

$this->title = 'Update Sensortype: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sensortypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'idSensor_Type' => $model->idSensor_Type]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sensortype-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
