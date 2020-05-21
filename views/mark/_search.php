<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MarkSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mark-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'value') ?>

    <?= $form->field($model, 'absent') ?>

    <?= $form->field($model, 'valuation_date') ?>

    <?= $form->field($model, 'subject_id') ?>

    <?php // echo $form->field($model, 'student_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
