<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SensortypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sensortypes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sensortype-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sensortype', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idSensor_Type',
            'name',
            'DataSize',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, app\models\Sensortype $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idSensor_Type' => $model->idSensor_Type]);
                 }
            ],
        ],
    ]); ?>


</div>
