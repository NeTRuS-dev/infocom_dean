<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HistoryOfAcademicLeaves */

$this->title = 'Изменение записи в истории об уходах в академический отпуск с id = ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'History Of Academic Leaves', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="history-of-academic-leaves-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
