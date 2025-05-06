<?php

use app\models\Distribuidora;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\DistribuidoraSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Distribuidoras');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="distribuidora-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Distribuidora'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'iddistribuidora',
            'nombre',
            'videojuego_idvideojuego',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Distribuidora $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'iddistribuidora' => $model->iddistribuidora]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
