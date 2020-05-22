<?php

/* @var $data_provider yii\data\BaseDataProvider */


/* @var $this yii\web\View */

use yii\bootstrap4\LinkPager;
use yii\helpers\Url;

$models = $data_provider->getModels();
?>
<div class="d-flex justify-content-center align-items-center flex-column mt-5">
    <img class="img-fluid mb-3" style="width: 55vw"
         src="<?= Url::to(['/site/get-graph',
             'groups' => array_column($models, 'Группа'),
             'marks' => array_column($models, 'Средняя оценка')]) ?>"
         alt="Graph">
    <?= LinkPager::widget([
        'pagination' => $data_provider->getPagination(),
    ]); ?>
</div>