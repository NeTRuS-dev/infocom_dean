<?php

/* @var $this yii\web\View */

$this->title = 'Деканат';
use yii\bootstrap4\LinkPager;
use yii\grid\GridView;

/* @var $data_provider yii\data\BaseDataProvider */
?>
<div class="d-flex justify-content-center align-items-center w-100 pt-5 pb-5">
    <?php echo GridView::widget([
        'summary' => '',
        'options' => ['class' => 'grid-view w-50'],
        'headerRowOptions' => ['class' => 'text-center'],
        'dataProvider' => $data_provider,
        'pager' => [
            'class' => LinkPager::class
        ]

    ]); ?>
</div>