<?php

/* @var $this yii\web\View */

/* @var $model \app\models\StudentSearchForm */


use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

?>
<div class="d-flex mt-5 justify-content-center align-items-center flex-column">
    <?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'name_pattern') ?>
    <?= $form->field($model, 'surname_pattern') ?>
    <?= $form->field($model, 'patronymic_pattern') ?>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end() ?>
</div>
