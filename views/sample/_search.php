<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SampleeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sample-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idSample') ?>

    <?= $form->field($model, 'idSensor') ?>

    <?= $form->field($model, 'value_1') ?>

    <?= $form->field($model, 'value_2') ?>

    <?= $form->field($model, 'value_3') ?>

    <?php // echo $form->field($model, 'timestamp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
