<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SessionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="session-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'idSession') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'start') ?>

    <?= $form->field($model, 'samples') ?>

    <?= $form->field($model, 'tp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
