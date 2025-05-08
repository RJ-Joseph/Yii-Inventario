<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "genero_has_videojuego".
 *
 * @property int $genero_idgenero
 * @property int $videojuego_idvideojuego
 *
 * @property Genero $generoIdgenero
 * @property Videojuego $videojuegoIdvideojuego
 */
class GeneroHasVideojuego extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genero_has_videojuego';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['genero_idgenero', 'videojuego_idvideojuego'], 'required'],
            [['genero_idgenero', 'videojuego_idvideojuego'], 'integer'],
            [['genero_idgenero', 'videojuego_idvideojuego'], 'unique', 'targetAttribute' => ['genero_idgenero', 'videojuego_idvideojuego']],
            [['genero_idgenero'], 'exist', 'skipOnError' => true, 'targetClass' => Genero::class, 'targetAttribute' => ['genero_idgenero' => 'idgenero']],
            [['videojuego_idvideojuego'], 'exist', 'skipOnError' => true, 'targetClass' => Videojuego::class, 'targetAttribute' => ['videojuego_idvideojuego' => 'idvideojuego']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'genero_idgenero' => Yii::t('app', 'Genero Idgenero'),
            'videojuego_idvideojuego' => Yii::t('app', 'Videojuego Idvideojuego'),
        ];
    }

    /**
     * Gets query for [[GeneroIdgenero]].
     *
     * @return \yii\db\ActiveQuery|GeneroQuery
     */
    public function getGeneroIdgenero()
    {
        return $this->hasOne(Genero::class, ['idgenero' => 'genero_idgenero']);
    }

    /**
     * Gets query for [[VideojuegoIdvideojuego]].
     *
     * @return \yii\db\ActiveQuery|VideojuegoQuery
     */
    public function getVideojuegoIdvideojuego()
    {
        return $this->hasOne(Videojuego::class, ['idvideojuego' => 'videojuego_idvideojuego']);
    }

    /**
     * {@inheritdoc}
     * @return GeneroHasVideojuegoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GeneroHasVideojuegoQuery(get_called_class());
    }

}
