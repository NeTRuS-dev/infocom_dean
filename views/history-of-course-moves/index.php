<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HistoryOfCourseMovesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'History Of Course Moves';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-of-course-moves-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create History Of Course Moves', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'old_course_number',
            'new_course_number',
            'student_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
