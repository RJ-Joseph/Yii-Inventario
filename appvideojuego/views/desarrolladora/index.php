<?php

use app\models\Desarrolladora;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\DesarrolladoraSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Desarrolladoras');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desarrolladora-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Desarrolladora'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'iddesarrolladora',
            'nombre',
           
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Desarrolladora $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'iddesarrolladora' => $model->iddesarrolladora]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
