<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sensortype */

$this->title = 'Create Sensortype';
$this->params['breadcrumbs'][] = ['label' => 'Sensortypes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sensortype-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
