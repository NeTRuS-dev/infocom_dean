<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\HistoryOfGroupChangingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'History Of Group Changings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-of-group-changing-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create History Of Group Changing', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'course_number',
            'previous_group_id',
            'new_group_id',
            'student_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
