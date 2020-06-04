<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HistoryOfCourseMoves */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="history-of-course-moves-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'old_course_number')->textInput() ?>

    <?= $form->field($model, 'new_course_number')->textInput() ?>

    <?= $form->field($model, 'student_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
