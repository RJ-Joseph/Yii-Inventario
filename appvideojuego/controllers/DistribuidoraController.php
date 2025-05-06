<?php

namespace app\controllers;

use app\models\Distribuidora;
use app\models\DistribuidoraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DistribuidoraController implements the CRUD actions for Distribuidora model.
 */
class DistribuidoraController extends Controller
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
     * Lists all Distribuidora models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DistribuidoraSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Distribuidora model.
     * @param int $iddistribuidora Iddistribuidora
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($iddistribuidora)
    {
        return $this->render('view', [
            'model' => $this->findModel($iddistribuidora),
        ]);
    }

    /**
     * Creates a new Distribuidora model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Distribuidora();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'iddistribuidora' => $model->iddistribuidora]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Distribuidora model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $iddistribuidora Iddistribuidora
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($iddistribuidora)
    {
        $model = $this->findModel($iddistribuidora);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'iddistribuidora' => $model->iddistribuidora]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Distribuidora model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $iddistribuidora Iddistribuidora
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($iddistribuidora)
    {
        $this->findModel($iddistribuidora)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Distribuidora model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $iddistribuidora Iddistribuidora
     * @return Distribuidora the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($iddistribuidora)
    {
        if (($model = Distribuidora::findOne(['iddistribuidora' => $iddistribuidora])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
