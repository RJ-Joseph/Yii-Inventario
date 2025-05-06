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
            [['videojuego_idvideojuego'], 'required'],
            [['videojuego_idvideojuego'], 'integer'],
            [['nombre'], 'string', 'max' => 50],
            [['videojuego_idvideojuego'], 'exist', 'skipOnError' => true, 'targetClass' => Videojuego::class, 'targetAttribute' => ['videojuego_idvideojuego' => 'idvideojuego']],
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
            'videojuego_idvideojuego' => Yii::t('app', 'Videojuego Idvideojuego'),
        ];
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
     * @return DistribuidoraQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DistribuidoraQuery(get_called_class());
    }

}
