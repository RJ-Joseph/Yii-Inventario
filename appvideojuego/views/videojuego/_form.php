<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Director;

/** @var yii\web\View $this */
/** @var app\models\Videojuego $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="videojuego-form">

    <?php $form = ActiveForm::begin(
        ['options' => ['enctype' => 'multipart/form-data']]
    ); ?>

    <?php if ($model->portada): ?>
        <div class="from-group">
            <?= Html::label('Imagen Actual') ?>
            <div>
                <?= Html::img(Yii::getAlias('@web' . '/portadas/' . $model->portada, ['style' => 'width:100px'])) ?>
            </div>

        </div>
    <?php endif; ?>

    <?php // $form->field($model, 'portada')->textInput(['maxlength' => true]) 
    ?>
    <?= $form->field($model, 'imageFile')->fileInput()->label('Sleccionar Imagen') ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true, 'placeholder' => 'Nombre del Videojuego', 'required' => true]) ?>

    <<?= $form->field($model, 'fechalanzamiento')->input('date', [
            'min' => '1900-01-01',
            'max' => date('Y-m-d'),
            'required' => true
        ]) ?>


        <?= $form->field($model, 'director_iddirector')->dropDownList(ArrayHelper::map(Director::find()->select(['iddirector', 'CONCAT(nombre,"",apellido) AS nombre_completo'])
            ->orderBy('nombre')
            ->asArray()
            ->all(), 'iddirector', 'nombre_completo'), ['prompt' => 'Seleccione un director', 'required' => true]) ?>

        <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>