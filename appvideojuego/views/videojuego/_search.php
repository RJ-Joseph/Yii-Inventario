<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\VideojuegoSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="videojuego-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idvideojuego') ?>

    <?= $form->field($model, 'portada') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'fechalanzamiento') ?>

    <?= $form->field($model, 'director_iddirector') ?>
    <?= $form->field($model, 'desarrolladora_iddesarrolladora') ?>
    <?= $form->field($model, 'distribuidora_iddistribuidora') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
