<?php
/* @var $this yii\web\View */

use app\models\GroupSearchForm;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var $items array[] */
/* @var $model GroupSearchForm */
?>
<div class="d-flex justify-content-center align-items-center mt-5 flex-column">
    <?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'group_id')->dropdownList($items, ['prompt' => 'Выберите группу студентов']) ?>
    <?= Html::submitButton('Перевести достойных', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end() ?>

</div>