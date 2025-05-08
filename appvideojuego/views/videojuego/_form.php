<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Director;
use app\models\Genero;
use app\models\Desarrolladora;
use app\models\Distribuidora;

/** @var yii\web\View $this */
/** @var app\models\Videojuego $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="videojuego-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?php if ($model->portada): ?>
        <div class="form-group">
            <?= Html::label('Imagen Actual') ?>
            <div>
                <?= Html::img(Yii::getAlias('@web/portadas/' . $model->portada), ['style' => 'width:100px']) ?>
            </div>
        </div>
    <?php endif; ?>

    <?= $form->field($model, 'imageFile')->fileInput()->label('Seleccionar Imagen') ?>

    <?= $form->field($model, 'nombre')->textInput([
        'maxlength' => true,
        'placeholder' => 'Nombre del Videojuego',
        'required' => true
    ]) ?>

    <?= $form->field($model, 'fechalanzamiento')->input('date', [
        'min' => '1900-01-01',
        'max' => date('Y-m-d'),
        'required' => true
    ]) ?>

    <?= $form->field($model, 'director_iddirector')->dropDownList(
        ArrayHelper::map(
            Director::find()
                ->select(['iddirector', "CONCAT(nombre, ' ', apellido) AS nombre_completo"])
                ->orderBy('nombre')
                ->asArray()
                ->all(),
            'iddirector',
            'nombre_completo'
        ),
        ['prompt' => 'Seleccione un director', 'required' => true]
    ) ?>

    <?= $form->field($model, 'desarrolladora_iddesarrolladora')->dropDownList(
        ArrayHelper::map(
            Desarrolladora::find()->orderBy('nombre')->all(),
            'iddesarrolladora',
            'nombre'
        ),
        ['prompt' => 'Seleccione una desarrolladora', 'required' => true]
    ) ?>

    <?= $form->field($model, 'distribuidora_iddistribuidora')->dropDownList(
        ArrayHelper::map(
            Distribuidora::find()->orderBy('nombre')->all(),
            'iddistribuidora',
            'nombre'
        ),
        ['prompt' => 'Seleccione una distribuidora', 'required' => true]
    ) ?>

    <div class="mb-3">
        <?= Html::label('Seleccione el Género', 'genders-search', ['class' => 'form-label']) ?>
        <div class="input-group">
            <input type="text" id="genders-search" placeholder="Buscar género" class="form-control">
            <a href="<?= Yii::$app->urlManager->createUrl(['genero/create']) ?>" class="btn btn-secondary">
                <i class="bi bi-box2-heart-fill"></i> Nuevo género
            </a>
        </div>

        <?= Html::activeListBox(
            $model,
            'genders',
            ArrayHelper::map(
                Genero::find()->orderBy(['nombre' => SORT_ASC])->all(),
                'idgenero',
                'nombre'
            ),
            [
                'multiple' => true,
                'size' => 10,
                'id' => 'genders-select',
                'class' => 'form-control mt-2'
            ]
        ) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>