<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Device */

$this->title = 'Update Device: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Devices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'idDevice' => $model->idDevice]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="device-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
