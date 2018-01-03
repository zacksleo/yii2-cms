<?php

namespace zacksleo\yii2\cms\models\queries;

use yii\db\ActiveQuery;
use zacksleo\yii2\cms\models\Item;

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

    public function active()
    {
        return $this->andFilterWhere(['status' => Item::STATUS_ACTIVE]);
    }
}
