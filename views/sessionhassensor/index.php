<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SessionhassensorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sessionhassensors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sessionhassensor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sessionhassensor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idSession',
            'idSensor',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, app\models\Sessionhassensor $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idSession' => $model->idSession, 'idSensor' => $model->idSensor]);
                 }
            ],
        ],
    ]); ?>


</div>
