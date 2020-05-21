<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SubjectAcademicPlan */

$this->title = 'Create Subject Academic Plan';
$this->params['breadcrumbs'][] = ['label' => 'Subject Academic Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subject-academic-plan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
