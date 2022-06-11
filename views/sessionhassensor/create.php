<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sessionhassensor */

$this->title = 'Create Sessionhassensor';
$this->params['breadcrumbs'][] = ['label' => 'Sessionhassensors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sessionhassensor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
