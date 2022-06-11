<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sensor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sensor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idDevice')->textInput() ?>

    <?= $form->field($model, 'idSensor_Type')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
