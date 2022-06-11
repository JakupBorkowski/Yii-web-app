<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Sessionhassensor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sessionhassensor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idSession')->textInput() ?>

    <?= $form->field($model, 'idSensor')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
