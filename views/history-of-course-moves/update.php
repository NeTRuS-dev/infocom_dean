<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HistoryOfCourseMoves */

$this->title = 'Изменение записи истории смены курсов с id = ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'History Of Course Moves', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="history-of-course-moves-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
