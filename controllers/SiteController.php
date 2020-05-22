<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\web\Controller;

class SiteController extends Controller
{


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
//        $data=Yii::$app->db->createCommand('CALL ')->queryAll();
        $query = (new Query())->from('grade_point_average_in_group');
        $provider = new ActiveDataProvider([
            'db' => Yii::$app->db,
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $this->render('index', [
            'data_provider' => $provider,
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionDisplayGraph()
    {
        $query = (new Query())->from('grade_point_average_in_group');
        $provider = new ActiveDataProvider([
            'db' => Yii::$app->db,
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('display-graph', [
            'data_provider' => $provider,
        ]);
    }

    /**
     * for img
     *
     * @return string
     */
    public function actionGetGraph()
    {
        $this->layout = false;
        Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->set('Content-Type', 'text/plain; charset=utf-8');
        return $this->render('graph-presenter', [
            'groups' => Yii::$app->request->queryParams['groups'],
            'marks' => Yii::$app->request->queryParams['marks'],
        ]);
    }
}
