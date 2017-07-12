<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Protocolo]].
 *
 * @see Protocolo
 */
class ProtocoloQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Protocolo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Protocolo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
