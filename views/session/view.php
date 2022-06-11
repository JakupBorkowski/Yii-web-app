<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Session */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="session-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'idSession' => $model->idSession], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'idSession' => $model->idSession], [
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
            'name',
            'start',
            'samples',
            'tp',
        ],
    ]) ?>

</div>
