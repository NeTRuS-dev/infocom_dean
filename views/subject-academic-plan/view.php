<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SubjectAcademicPlan */

$this->title = $model->subject_id;
$this->params['breadcrumbs'][] = ['label' => 'Subject Academic Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="subject-academic-plan-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'subject_id' => $model->subject_id, 'academic_plan_id' => $model->academic_plan_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'subject_id' => $model->subject_id, 'academic_plan_id' => $model->academic_plan_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить этот элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'subject_id',
            'academic_plan_id',
            'number_of_lecture_hours',
            'hours_of_practical_training',
        ],
    ]) ?>

</div>
