<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EducationFormat */

$this->title = 'Create Education Format';
$this->params['breadcrumbs'][] = ['label' => 'Education Formats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="education-format-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
