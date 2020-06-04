<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\HistoryOfGroupChanging */

$this->title = 'Создание записи истории смены группы студентом';
$this->params['breadcrumbs'][] = ['label' => 'History Of Group Changings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-of-group-changing-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
