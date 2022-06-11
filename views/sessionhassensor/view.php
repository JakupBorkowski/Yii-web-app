<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sessionhassensor */

$this->title = $model->idSession;
$this->params['breadcrumbs'][] = ['label' => 'Sessionhassensors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="sessionhassensor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idSession' => $model->idSession, 'idSensor' => $model->idSensor], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idSession' => $model->idSession, 'idSensor' => $model->idSensor], [
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
            'idSession',
            'idSensor',
        ],
    ]) ?>

</div>
