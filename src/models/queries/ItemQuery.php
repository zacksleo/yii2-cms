<?php

namespace zacksleo\yii2\cms\models\queries;

use yii\db\ActiveQuery;

/**
 * Class PostQuery
 * @package zacksleo\yii2\cms\models
 * @author zacksleo <zacksleo@gmail.com>
 */
class ItemQuery extends ActiveQuery
{
    public function category($id)
    {
        return $this->andFilterWhere(['like', 'categories', ",$id,"]);
    }
}
