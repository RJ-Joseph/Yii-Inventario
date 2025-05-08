<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[GeneroHasVideojuego]].
 *
 * @see GeneroHasVideojuego
 */
class GeneroHasVideojuegoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return GeneroHasVideojuego[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return GeneroHasVideojuego|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
