<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HistoryOfAcademicLeaves */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="history-of-academic-leaves-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date_of_beginning')->textInput() ?>

    <?= $form->field($model, 'date_of_ending')->textInput() ?>

    <?= $form->field($model, 'student_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
