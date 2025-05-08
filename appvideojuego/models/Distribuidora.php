<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "distribuidora".
 *
 * @property int $iddistribuidora
 * @property string|null $nombre
 * @property int $videojuego_idvideojuego
 *
 * @property Videojuego $videojuegoIdvideojuego
 */
class Distribuidora extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'distribuidora';
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
            'iddistribuidora' => Yii::t('app', 'Iddistribuidora'),
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
        return $this->hasMany(Videojuego::class, ['iddistribuidora' => 'distribuidora_iddistribuidora']);
    }

    /**
     * {@inheritdoc}
     * @return DistribuidoraQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DistribuidoraQuery(get_called_class());
    }

}
