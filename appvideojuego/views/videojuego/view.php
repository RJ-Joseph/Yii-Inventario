<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Videojuego $model */

$this->title = $model->idvideojuego;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Videojuegos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="videojuego-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'idvideojuego' => $model->idvideojuego], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'idvideojuego' => $model->idvideojuego], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idvideojuego',
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
            'director_iddirector',
            'desarrolladora_iddesarrolladora',
            'distribuidora_iddistribuidora',
        ],
    ]) ?>

</div>