<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sensortype */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sensortypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sensortype-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idSensor_Type' => $model->idSensor_Type], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idSensor_Type' => $model->idSensor_Type], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idSensor_Type',
            'name',
            'DataSize',
        ],
    ]) ?>

</div>
