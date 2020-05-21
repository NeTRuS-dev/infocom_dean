<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SubjectAcademicPlan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subject-academic-plan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'subject_id')->textInput() ?>

    <?= $form->field($model, 'academic_plan_id')->textInput() ?>

    <?= $form->field($model, 'number_of_lecture_hours')->textInput() ?>

    <?= $form->field($model, 'hours_of_practical_training')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
