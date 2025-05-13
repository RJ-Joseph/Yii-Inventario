<?php

namespace app\controllers;

use Yii;
use app\models\Distribuidora;
use app\models\DistribuidoraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class DistribuidoraController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['index', 'view', 'create', 'update', 'delete'],
                    'rules' => [
                        [
                            'allow' => true,
                            'actions' => ['index', 'view'],
                            'roles' => ['@'], // cualquier usuario autenticado
                        ],
                        [
                            'allow' => true,
                            'actions' => ['create', 'update', 'delete'],
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                                return Yii::$app->user->identity->role === 'admin';
                            },
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function actionIndex()
    {
        $searchModel = new DistribuidoraSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($iddistribuidora)
    {
        return $this->render('view', [
            'model' => $this->findModel($iddistribuidora),
        ]);
    }

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

    public function actionDelete($iddistribuidora)
    {
        $this->findModel($iddistribuidora)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($iddistribuidora)
    {
        if (($model = Distribuidora::findOne(['iddistribuidora' => $iddistribuidora])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
