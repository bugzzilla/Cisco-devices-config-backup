<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Joblog]].
 *
 * @see Joblog
 */
class JoblogQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Joblog[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Joblog|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
