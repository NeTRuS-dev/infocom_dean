<?php
/* @var $data_provider yii\data\BaseDataProvider */

/* @var $this yii\web\View */

use yii\bootstrap4\LinkPager;

function rand_color()
{
    return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
}

require_once(Yii::getAlias('@app') . '/JpGraph/jpgraph.php');
require_once(Yii::getAlias('@app') . '/JpGraph/jpgraph_bar.php');

$graph = new Graph(800, 600, 'auto');
$graph->SetScale("textlin");

$theme_class = new AquaTheme;
$graph->SetTheme($theme_class);

$graph->yaxis->SetTickPositions(array(2, 3, 4, 5), array(2.5, 3.5, 4.5));
$graph->SetBox(false);

$graph->ygrid->SetFill(false);
$models = $data_provider->getModels();
$graph->xaxis->SetTickLabels(array_map(function ($model) {
    return $model['Группа'];
}, $models));
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false, false);
$graph->xaxis->SetLabelAngle(90);
foreach ($models as $model) {
    $bar = new BarPlot([$model['Средняя оценка']]);
    $bar->SetColor("white");
    $bar->SetFillColor(rand_color());
    $graph->Add($bar);
}
// Display the graph
$graph->Stroke();

echo LinkPager::widget([
    'pagination' => $data_provider->getPagination(),
]);