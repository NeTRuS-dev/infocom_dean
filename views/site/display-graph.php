<?php

/* @var $paginator \yii\data\Pagination */

/* @var $this yii\web\View */

use yii\bootstrap4\LinkPager;

?>
    <img class="img-fluid" src="<?= \yii\helpers\Url::to('/site/get-graph') ?>" alt="Graph">
<?= LinkPager::widget([
    'pagination' => $paginator,
]); ?>