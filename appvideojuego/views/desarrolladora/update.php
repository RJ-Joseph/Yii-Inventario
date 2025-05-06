<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Desarrolladora $model */

$this->title = Yii::t('app', 'Update Desarrolladora: {name}', [
    'name' => $model->iddesarrolladora,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Desarrolladoras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->iddesarrolladora, 'url' => ['view', 'iddesarrolladora' => $model->iddesarrolladora]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="desarrolladora-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
