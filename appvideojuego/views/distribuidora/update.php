<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Distribuidora $model */

$this->title = Yii::t('app', 'Update Distribuidora: {name}', [
    'name' => $model->iddistribuidora,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Distribuidoras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->iddistribuidora, 'url' => ['view', 'iddistribuidora' => $model->iddistribuidora]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="distribuidora-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
