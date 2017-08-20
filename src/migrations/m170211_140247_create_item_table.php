<?php

use yii\db\Schema;

class m170211_140247_create_item_table extends \yii\db\Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%item}}', [
            'id' => Schema::TYPE_PK,
            'item_name' => Schema::TYPE_STRING . '(125) NOT NULL COMMENT "商品名称"',
            "subtitle" => Schema::TYPE_STRING . '(125) NOT NULL COMMENT "副标题"',
            'categories' => Schema::TYPE_STRING . ' NOT NULL COMMENT "商品类别"',
            'market_price' => Schema::TYPE_DECIMAL . '(10,2) NOT NULL DEFAULT 0 COMMENT "市场价"',
            'price' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0 COMMENT "价格"',
            'description' => Schema::TYPE_TEXT . ' NOT NULL COMMENT "商品属性"',
            'logo_image' => Schema::TYPE_STRING . ' NOT NULL DEFAULT "/images/icon-image.png" COMMENT "缩略图"',
            'status' => Schema::TYPE_BOOLEAN . ' NOT NULL DEFAULT 1 COMMENT "状态"',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "创建时间"',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "更新时间"',
        ], $tableOptions);
        return true;
    }

    public function down()
    {
        $this->dropTable('{{%item}}');
        return true;
    }
}
