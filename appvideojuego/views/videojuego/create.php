<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Videojuego $model */

$this->title = Yii::t('app', 'Create Videojuego');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Videojuegos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videojuego-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
