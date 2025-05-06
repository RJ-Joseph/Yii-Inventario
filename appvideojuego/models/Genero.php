<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "genero".
 *
 * @property int $idgenero
 * @property string|null $nombre
 *
 * @property GeneroHasVideojuego[] $generoHasVideojuegos
 * @property Videojuego[] $videojuegoIdvideojuegos
 */
class Genero extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genero';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'default', 'value' => null],
            [['nombre'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idgenero' => Yii::t('app', 'Idgenero'),
            'nombre' => Yii::t('app', 'Nombre'),
        ];
    }

    /**
     * Gets query for [[GeneroHasVideojuegos]].
     *
     * @return \yii\db\ActiveQuery|GeneroHasVideojuegoQuery
     */
    public function getGeneroHasVideojuegos()
    {
        return $this->hasMany(GeneroHasVideojuego::class, ['genero_idgenero' => 'idgenero']);
    }

    /**
     * Gets query for [[VideojuegoIdvideojuegos]].
     *
     * @return \yii\db\ActiveQuery|VideojuegoQuery
     */
    public function getVideojuegoIdvideojuegos()
    {
        return $this->hasMany(Videojuego::class, ['idvideojuego' => 'videojuego_idvideojuego'])->viaTable('genero_has_videojuego', ['genero_idgenero' => 'idgenero']);
    }

    /**
     * {@inheritdoc}
     * @return GeneroQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GeneroQuery(get_called_class());
    }

}
