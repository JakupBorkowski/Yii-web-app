<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Device */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="device-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'additionDate')->textInput() ?>

    <?= $form->field($model, 'lastActualization')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
