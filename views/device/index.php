<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DeviceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Devices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Device', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idDevice',
            'name',
            'description',
            'additionDate',
            'lastActualization',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, app\models\Device $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idDevice' => $model->idDevice]);
                 }
            ],
        ],
    ]); ?>


</div>
