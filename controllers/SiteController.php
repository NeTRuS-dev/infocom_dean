<?php

namespace app\controllers;

use app\models\DataContainer;
use app\models\StudentSearchForm;
use Yii;
use yii\data\ActiveDataProvider;
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

    /**
     * @return string
     */
    public function actionGetPersonalCard()
    {
        $model = new StudentSearchForm();
        if (empty(Yii::$app->request->get())) {
            Yii::$app->session->removeAllFlashes();
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //gets all ids
            $students_ids = Yii::$app->db->createCommand('CALL GetStudentsIDsByNames(:name_pattern, :surname_pattern, :patronymic_pattern)')
                ->bindValue(':name_pattern', $model->name_pattern)
                ->bindValue(':surname_pattern', $model->surname_pattern)
                ->bindValue(':patronymic_pattern', $model->patronymic_pattern)
                ->queryAll();
            $data_containers = [];
            foreach ($students_ids as $item) {
                $student_id = $item['id'];
                $new_cotainer = new DataContainer();
                $new_cotainer->main_data = Yii::$app->db->createCommand('CALL GetMainDataAboutStudent(:id)')
                    ->bindValue(':id', $student_id)
                    ->queryAll();

                $new_cotainer->subjects_data = Yii::$app->db->createCommand('CALL GetSubjectsDataAboutStudent(:id)')
                    ->bindValue(':id', $student_id)
                    ->queryAll();

                $new_cotainer->history_data = Yii::$app->db->createCommand('CALL GetHistoryDataAboutStudent(:id)')
                    ->bindValue(':id', $student_id)
                    ->queryAll();
                $data_containers[] = $new_cotainer;
            }
            Yii::$app->session->setFlash('stored_data_containers', $data_containers);
            return $this->render('students-displayer', compact('data_containers'));

        } else if (Yii::$app->session->has('stored_data_containers')) {
            $data_containers = Yii::$app->session->getFlash('stored_data_containers', null, true);
            Yii::$app->session->setFlash('stored_data_containers', $data_containers);

            return $this->render('students-displayer', compact('data_containers'));
        } else {
            return $this->render('select-student', compact('model'));
        }
    }
}
