<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HistoryOfCourseMoves */

$this->title = 'Create History Of Course Moves';
$this->params['breadcrumbs'][] = ['label' => 'History Of Course Moves', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-of-course-moves-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
