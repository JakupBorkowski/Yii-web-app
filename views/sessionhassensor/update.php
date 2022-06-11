<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sessionhassensor */

$this->title = 'Update Sessionhassensor: ' . $model->idSession;
$this->params['breadcrumbs'][] = ['label' => 'Sessionhassensors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idSession, 'url' => ['view', 'idSession' => $model->idSession, 'idSensor' => $model->idSensor]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sessionhassensor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
