<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Videojuego $model */

$this->title = Yii::t('app', 'Update Videojuego: {name}', [
    'name' => $model->idvideojuego,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Videojuegos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idvideojuego, 'url' => ['view', 'idvideojuego' => $model->idvideojuego]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="videojuego-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
