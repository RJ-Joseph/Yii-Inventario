<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "desarrolladora".
 *
 * @property int $iddesarrolladora
 * @property string|null $nombre
 * @property int $videojuego_idvideojuego
 *
 * @property Videojuego $videojuegoIdvideojuego
 */
class Desarrolladora extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'desarrolladora';
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
            'iddesarrolladora' => Yii::t('app', 'Iddesarrolladora'),
            'nombre' => Yii::t('app', 'Nombre'),

        ];
    }

    /**
     * Gets query for [[VideojuegoIdvideojuego]].
     *
     * @return \yii\db\ActiveQuery|VideojuegoQuery
     */
    public function getVideojuegoIdvideojuego()
    {
        return $this->hasMany(Videojuego::class, ['idvideojuego' => 'videojuego_idvideojuego']);
    }

    /**
     * {@inheritdoc}
     * @return DesarrolladoraQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DesarrolladoraQuery(get_called_class());
    }

}
