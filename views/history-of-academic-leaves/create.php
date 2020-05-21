<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HistoryOfAcademicLeaves */

$this->title = 'Create History Of Academic Leaves';
$this->params['breadcrumbs'][] = ['label' => 'History Of Academic Leaves', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-of-academic-leaves-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
