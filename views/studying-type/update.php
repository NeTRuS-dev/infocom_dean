<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StudyingType */

$this->title = 'Update Studying Type: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Studying Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="studying-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
