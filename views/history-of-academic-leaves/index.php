<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HistoryOfAcademicLeavesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'History Of Academic Leaves';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-of-academic-leaves-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create History Of Academic Leaves', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date_of_beginning',
            'date_of_ending',
            'student_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
