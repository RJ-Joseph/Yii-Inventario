<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Videojuego]].
 *
 * @see Videojuego
 */
class VideojuegoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Videojuego[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Videojuego|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
