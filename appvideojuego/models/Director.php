<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "director".
 *
 * @property int $iddirector
 * @property string|null $nombre
 * @property string|null $apellido
 *
 * @property Videojuego[] $videojuegos
 */
class Director extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'director';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido'], 'default', 'value' => null],
            [['nombre', 'apellido'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'iddirector' => Yii::t('app', 'Iddirector'),
            'nombre' => Yii::t('app', 'Nombre'),
            'apellido' => Yii::t('app', 'Apellido'),
        ];
    }

    /**
     * Gets query for [[Videojuegos]].
     *
     * @return \yii\db\ActiveQuery|VideojuegoQuery
     */
    public function getVideojuegos()
    {
        return $this->hasMany(Videojuego::class, ['director_iddirector' => 'iddirector']);
    }

    /**
     * {@inheritdoc}
     * @return DirectorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DirectorQuery(get_called_class());
    }

}
