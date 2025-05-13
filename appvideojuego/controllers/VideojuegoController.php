<?php

namespace app\controllers;

use Yii;
use app\models\Videojuego;
use app\models\VideojuegoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;

class VideojuegoController extends Controller
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
                            'roles' => ['@'],
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
        $searchModel = new VideojuegoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($idvideojuego)
    {
        return $this->render('view', [
            'model' => $this->findModel($idvideojuego),
        ]);
    }

    public function actionCreate()
    {
        $model = new Videojuego();
        $message = '';

        if ($this->request->isPost) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($model->load($this->request->post())) {
                    $model->genders = Yii::$app->request->post('Videojuego')['genders'] ?? [];
                    $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

                    if ($model->upload()) {
                        $transaction->commit();
                        return $this->redirect(['view', 'idvideojuego' => $model->idvideojuego]);
                    } else {
                        $message = 'Error al guardar el videojuego.';
                        $transaction->rollBack();
                    }
                } else {
                    $message = 'Error al cargar datos del formulario.';
                    $transaction->rollBack();
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                $message = 'Excepción al guardar: ' . $e->getMessage();
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'message' => $message,
        ]);
    }

    public function actionUpdate($idvideojuego)
    {
        $model = $this->findModel($idvideojuego);
        $message = '';

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->genders = Yii::$app->request->post('Videojuego')['genders'] ?? [];
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if ($model->upload()) {
                return $this->redirect(['view', 'idvideojuego' => $model->idvideojuego]);
            } else {
                $message = 'Error al guardar el videojuego.';
            }
        }

        return $this->render('update', [
            'model' => $model,
            'message' => $message,
        ]);
    }

    public function actionDelete($idvideojuego)
    {
        $model = $this->findModel($idvideojuego);
        $model->deletePortada();
        $model->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($idvideojuego)
    {
        if (($model = Videojuego::findOne(['idvideojuego' => $idvideojuego])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
