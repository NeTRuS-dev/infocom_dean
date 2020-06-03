<?php
/* @var $data_containers \app\models\DataContainer[] */

use app\models\DataContainer;
use yii\bootstrap4\LinkPager;
use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
$this->title = 'Отчёт';

/**
 * @param array $data
 * @param string $page_param
 * @param string $sort_param
 */
function display_data(array $data, string $page_param, string $sort_param)
{
    $data_provider = new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => [
                'pageSize' => 10,
                'pageParam' => $page_param,
            ],
            'sort' => [
                'sortParam' => $sort_param
            ]
        ]
    );
    echo GridView::widget([
        'summary' => '',
        'options' => ['class' => 'grid-view w-50'],
        'headerRowOptions' => ['class' => 'text-center'],
        'dataProvider' => $data_provider,
        'pager' => [
            'class' => LinkPager::class,
            'options' => ['class' => 'd-flex justify-content-center align-items-center'],
        ]

    ]);
}

/**
 * @param DataContainer $container
 * @param int $index
 */
function display_data_container(DataContainer $container, int $index)
{
    display_data($container->main_data, $index . '-1-data-page', $index . '-1-data-sort');
    display_data($container->subjects_data, $index . '-2-data-page', $index . '-2-data-sort');
    display_data($container->history_data, $index . '-3-data-page', $index . '-3-data-sort');
}

?>
<?php Pjax::begin() ?>
<div class="d-flex justify-content-center align-items-center flex-column">
    <?php
    if (!empty($data_containers)) {
        foreach ($data_containers as $index => $data_container) {
            display_data_container($data_container, $index);
        }
    } else {
        echo '<span class="h1 mt-5">Ничего не найдено</span>';
    }
    ?>

</div>
<?php Pjax::end() ?>






