<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SensorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sensors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sensor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sensor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idSensor',
            'idDevice',
            'idSensor_Type',
            'name',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, app\models\Sensor $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idSensor' => $model->idSensor]);
                 }
            ],
        ],
    ]); ?>


</div>
