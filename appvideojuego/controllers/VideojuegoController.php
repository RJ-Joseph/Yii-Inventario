<?php

namespace app\controllers;

use yii;
use app\models\Videojuego;
use app\models\VideojuegoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * VideojuegoController implements the CRUD actions for Videojuego model.
 */
class VideojuegoController extends Controller
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
     * Lists all Videojuego models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VideojuegoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Videojuego model.
     * @param int $idvideojuego Idvideojuego
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idvideojuego)
    {
        return $this->render('view', [
            'model' => $this->findModel($idvideojuego),
        ]);
    }

    /**
     * Creates a new Videojuego model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
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

    /**
     * Updates an existing Videojuego model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idvideojuego Idvideojuego
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
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

    /**
     * Deletes an existing Videojuego model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idvideojuego Idvideojuego
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idvideojuego)
    {
        $model = $this->findModel($idvideojuego);
        $model->deletePortada();
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Videojuego model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idvideojuego Idvideojuego
     * @return Videojuego the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idvideojuego)
    {
        if (($model = Videojuego::findOne(['idvideojuego' => $idvideojuego])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
