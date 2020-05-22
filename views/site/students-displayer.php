<?php
/* @var $data_containers \app\models\DataContainer[] */

use app\models\DataContainer;
use yii\bootstrap4\LinkPager;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;

/* @var $this yii\web\View */
/**
 * @param \app\models\DataContainer $container
 * @param int $index
 * @throws Exception
 */
function display_data_container(DataContainer $container, int $index)
{
    $data_provider = new ArrayDataProvider([
            'allModels' => $container->main_data,
            'pagination' => [
                'pageSize' => 10,
                'pageParam' => $index . '-data-page',
            ],
            'sort' => [
                'sortParam' => $index . '-data-sort'
            ]
        ]
    );
    echo GridView::widget([
        'summary' => '',
        'options' => ['class' => 'grid-view w-50'],
        'headerRowOptions' => ['class' => 'text-center'],
        'dataProvider' => $data_provider,
        'pager' => [
            'class' => LinkPager::class
        ]

    ]);
}




