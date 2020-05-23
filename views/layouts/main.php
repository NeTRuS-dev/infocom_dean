<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use app\assets\AppAsset;
use yii\helpers\Inflector;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Деканат',
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right ml-auto'],
        'items' => [
            [
                'label' => 'Отчёты',
                'items' => [
                    ['label' => 'Средний балл в группе таблица', 'url' => ['/']],
                    ['label' => 'Средний балл в группе диаграмма', 'url' => ['/site/display-graph']],
                ],
            ],
            [
                'label' => 'Запросы',
                'items' => [
                    ['label' => 'Студенты с плохой успеваемостью', 'url' => ['/site/' . Inflector::camel2id('GetLosers')]],
                ],
            ],
            [
                'label' => 'Личная карточка студента',
                'url' => ['/site/get-personal-card']
            ],
            [
                'label' => 'Сущности',
                'items' => [
                    ['label' => 'Кафедра', 'url' => ['/department/index']],
                    ['label' => 'Специальности', 'url' => ['/specialty/index']],
                    ['label' => 'Группы', 'url' => ['/group/index']],
                    ['label' => 'Студенты', 'url' => ['/student/index']],
                    ['label' => 'Учебные планы', 'url' => ['/academic-plan/index']],
                    ['label' => 'Предметы', 'url' => ['/subject/index']],
                    ['label' => 'Оценки', 'url' => ['/mark/index']],
                    ['label' => 'История уходов в академический отпуск', 'url' => ['/' . Inflector::camel2id('HistoryOfAcademicLeaves') . '/index']],
                    ['label' => 'История переходов между курсами', 'url' => ['/' . Inflector::camel2id('HistoryOfCourseMoves') . '/index']],
                    ['label' => 'История смен групп', 'url' => ['/' . Inflector::camel2id('HistoryOfGroupChanging') . '/index']],
                    ['label' => 'Оценки', 'url' => ['/mark/index']],
                ],
            ],

        ],
    ]);
    NavBar::end();
    ?>

    <div class="content">
        <?= $content ?>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
