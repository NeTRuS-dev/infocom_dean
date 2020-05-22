<?php
/* @var $groups array */
/* @var $marks array */

/* @var $this yii\web\View */

require_once(Yii::getAlias('@app') . '/JpGraph/jpgraph.php');
require_once(Yii::getAlias('@app') . '/JpGraph/jpgraph_bar.php');

$graph = new Graph(1080, 720, 'auto');
$graph->SetMargin(20, 20, 0, 20);
$graph->SetScale("textlin");

$theme_class = new AquaTheme;
$graph->SetTheme($theme_class);

$graph->yaxis->SetTickPositions(array(2, 3, 4, 5), array(2.5, 3.5, 4.5));
$graph->SetBox(false);

$graph->ygrid->SetFill(false);
$graph->xaxis->SetTickLabels($groups);
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false, false);
$graph->xaxis->SetLabelAngle(50);
$bar = new BarPlot($marks);
$bar->SetColor("white");
$bar->SetWidth(50);
$bar->SetFillGradient("#159100", "white", GRAD_LEFT_REFLECTION);
$graph->Add($bar);
$graph->title->Set("Cредний балл в группе по изучаемым дисциплинам");
$graph->Stroke();
