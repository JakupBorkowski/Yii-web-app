<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SessionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sessions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="session-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Session', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'idSession',
            'name',
            'start',
            'samples',
            'tp',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, app\models\Session $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idSession' => $model->idSession]);
                 }
            ],
        ],
    ]); ?>


</div>
