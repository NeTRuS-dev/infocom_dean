<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SubjectAcademicPlanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="subject-academic-plan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'subject_id') ?>

    <?= $form->field($model, 'academic_plan_id') ?>

    <?= $form->field($model, 'number_of_lecture_hours') ?>

    <?= $form->field($model, 'hours_of_practical_training') ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Сброс', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
