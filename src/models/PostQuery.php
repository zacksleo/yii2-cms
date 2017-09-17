<?php

namespace zacksleo\yii2\cms\models;

use yii\db\ActiveQuery;
use creocoder\taggable\TaggableQueryBehavior;

/**
 * Class PostQuery
 * @package zacksleo\yii2\cms\models
 * @author zacksleo <zacksleo@gmail.com>
 */
class PostQuery extends ActiveQuery
{
    public function behaviors()
    {
        return [
            TaggableQueryBehavior::className(),
        ];
    }

    public function category($id)
    {
        return $this->andFilterWhere(['like', 'categories', ",$id,"]);
    }
}
