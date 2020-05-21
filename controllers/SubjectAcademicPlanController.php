<?php

namespace app\controllers;

use Yii;
use app\models\SubjectAcademicPlan;
use app\models\SubjectAcademicPlanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SubjectAcademicPlanController implements the CRUD actions for SubjectAcademicPlan model.
 */
class SubjectAcademicPlanController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SubjectAcademicPlan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SubjectAcademicPlanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SubjectAcademicPlan model.
     * @param integer $subject_id
     * @param integer $academic_plan_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($subject_id, $academic_plan_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($subject_id, $academic_plan_id),
        ]);
    }

    /**
     * Creates a new SubjectAcademicPlan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SubjectAcademicPlan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'subject_id' => $model->subject_id, 'academic_plan_id' => $model->academic_plan_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SubjectAcademicPlan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $subject_id
     * @param integer $academic_plan_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($subject_id, $academic_plan_id)
    {
        $model = $this->findModel($subject_id, $academic_plan_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'subject_id' => $model->subject_id, 'academic_plan_id' => $model->academic_plan_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SubjectAcademicPlan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $subject_id
     * @param integer $academic_plan_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($subject_id, $academic_plan_id)
    {
        $this->findModel($subject_id, $academic_plan_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SubjectAcademicPlan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $subject_id
     * @param integer $academic_plan_id
     * @return SubjectAcademicPlan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($subject_id, $academic_plan_id)
    {
        if (($model = SubjectAcademicPlan::findOne(['subject_id' => $subject_id, 'academic_plan_id' => $academic_plan_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
