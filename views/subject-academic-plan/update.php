<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SubjectAcademicPlan */

$this->title = 'Update Subject Academic Plan: ' . $model->subject_id;
$this->params['breadcrumbs'][] = ['label' => 'Subject Academic Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->subject_id, 'url' => ['view', 'subject_id' => $model->subject_id, 'academic_plan_id' => $model->academic_plan_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="subject-academic-plan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
