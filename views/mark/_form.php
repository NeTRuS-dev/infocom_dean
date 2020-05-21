<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Mark */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mark-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'value')->textInput() ?>

    <?= $form->field($model, 'absent')->textInput() ?>

    <?= $form->field($model, 'valuation_date')->textInput() ?>

    <?= $form->field($model, 'subject_id')->textInput() ?>

    <?= $form->field($model, 'student_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
