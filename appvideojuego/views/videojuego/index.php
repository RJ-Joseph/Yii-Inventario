<?php

use app\models\Videojuego;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\VideojuegoSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Videojuegos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videojuego-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Videojuego'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'idvideojuego',
            //'portada',
            [
                'attribute' => 'portada',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img(Yii::getAlias('@web') . '/portadas/' . $model->portada, ['style' => 'width: 100px']);
                }
            ],
            'nombre',
            'fechalanzamiento',
            [
                'attribute' => 'generoNombre',
                'label' => 'Género',
                'value' => function ($model) {
                    return implode(', ', \yii\helpers\ArrayHelper::getColumn($model->generoIdgeneros, 'nombre'));
                },
            ],
            'director_iddirector',
            'desarrolladora_iddesarrolladora',
            'distribuidora_iddistribuidora',

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Videojuego $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'idvideojuego' => $model->idvideojuego]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>