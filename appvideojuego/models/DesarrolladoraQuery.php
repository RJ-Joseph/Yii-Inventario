<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Desarrolladora]].
 *
 * @see Desarrolladora
 */
class DesarrolladoraQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Desarrolladora[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Desarrolladora|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
