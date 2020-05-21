<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MarkSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Marks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mark-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Mark', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'value',
            'absent',
            'valuation_date',
            'subject_id',
            //'student_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('Посмотреть', $url, ['class' => 'btn btn-info m-1']);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('Изменить', $url, ['class' => 'btn btn-primary m-1']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('Удалить', $url, ['class' => 'btn btn-danger m-1']);
                    },
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
