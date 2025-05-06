<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Distribuidora $model */

$this->title = Yii::t('app', 'Create Distribuidora');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Distribuidoras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="distribuidora-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
