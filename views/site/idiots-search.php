<?php
/* @var $this yii\web\View */

/* @var $model LosersSearchForm */
/* @var $items array[] */

use app\models\LosersSearchForm;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

?>
<div class="d-flex justify-content-center align-items-center mt-3 flex-column">
    <?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'start_date')->input('date') ?>
    <?= $form->field($model, 'end_date')->input('date') ?>
    <?= $form->field($model, 'subject_id')->dropdownList($items, ['prompt' => 'Выберите предмет']) ?>
    <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end() ?>

</div>