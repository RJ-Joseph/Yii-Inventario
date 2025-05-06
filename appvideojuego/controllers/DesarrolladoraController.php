<?php

namespace app\controllers;

use app\models\Desarrolladora;
use app\models\DesarrolladoraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DesarrolladoraController implements the CRUD actions for Desarrolladora model.
 */
class DesarrolladoraController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Desarrolladora models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DesarrolladoraSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Desarrolladora model.
     * @param int $iddesarrolladora Iddesarrolladora
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($iddesarrolladora)
    {
        return $this->render('view', [
            'model' => $this->findModel($iddesarrolladora),
        ]);
    }

    /**
     * Creates a new Desarrolladora model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Desarrolladora();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'iddesarrolladora' => $model->iddesarrolladora]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Desarrolladora model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $iddesarrolladora Iddesarrolladora
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($iddesarrolladora)
    {
        $model = $this->findModel($iddesarrolladora);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'iddesarrolladora' => $model->iddesarrolladora]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Desarrolladora model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $iddesarrolladora Iddesarrolladora
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($iddesarrolladora)
    {
        $this->findModel($iddesarrolladora)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Desarrolladora model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $iddesarrolladora Iddesarrolladora
     * @return Desarrolladora the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($iddesarrolladora)
    {
        if (($model = Desarrolladora::findOne(['iddesarrolladora' => $iddesarrolladora])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
