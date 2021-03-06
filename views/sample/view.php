<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sample */

$this->title = $model->idSample;
$this->params['breadcrumbs'][] = ['label' => 'Samples', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sample-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idSample' => $model->idSample], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idSample' => $model->idSample], [
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
            'idSample',
            'idSensor',
            'value_1',
            'value_2',
            'value_3',
            'timestamp',
        ],
    ]) ?>

</div>
