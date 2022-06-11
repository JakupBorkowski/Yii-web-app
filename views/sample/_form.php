<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sample */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sample-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idSensor')->textInput() ?>

    <?= $form->field($model, 'value_1')->textInput() ?>

    <?= $form->field($model, 'value_2')->textInput() ?>

    <?= $form->field($model, 'value_3')->textInput() ?>

    <?= $form->field($model, 'timestamp')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
