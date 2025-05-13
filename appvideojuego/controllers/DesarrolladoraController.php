<?php

namespace app\controllers;

use Yii;
use app\models\Desarrolladora;
use app\models\DesarrolladoraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class DesarrolladoraController extends Controller
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
                            'roles' => ['@'], // usuarios autenticados
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
        $searchModel = new DesarrolladoraSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($iddesarrolladora)
    {
        return $this->render('view', [
            'model' => $this->findModel($iddesarrolladora),
        ]);
    }

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

    public function actionDelete($iddesarrolladora)
    {
        $this->findModel($iddesarrolladora)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($iddesarrolladora)
    {
        if (($model = Desarrolladora::findOne(['iddesarrolladora' => $iddesarrolladora])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
