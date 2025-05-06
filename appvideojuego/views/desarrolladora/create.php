<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Desarrolladora $model */

$this->title = Yii::t('app', 'Create Desarrolladora');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Desarrolladoras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="desarrolladora-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
