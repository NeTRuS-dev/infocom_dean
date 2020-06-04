<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StudyingType */

$this->title = 'Создание типа обучения';
$this->params['breadcrumbs'][] = ['label' => 'Studying Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="studying-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
