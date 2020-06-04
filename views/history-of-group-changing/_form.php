<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\HistoryOfGroupChanging */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="history-of-group-changing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'course_number')->textInput() ?>

    <?= $form->field($model, 'previous_group_id')->textInput() ?>

    <?= $form->field($model, 'new_group_id')->textInput() ?>

    <?= $form->field($model, 'student_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
