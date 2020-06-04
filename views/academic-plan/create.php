<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AcademicPlan */

$this->title = 'Создание учебного плана';
$this->params['breadcrumbs'][] = ['label' => 'Academic Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="academic-plan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
