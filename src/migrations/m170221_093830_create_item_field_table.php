<?php

use yii\db\Migration;

class m170221_093830_create_item_field_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%item_field}}', [
            'item_id' => $this->integer()->notNull(),
            'type' => $this->string()->notNull(),
            'key' => $this->string()->notNull(),
            'value' => $this->text(),
        ], $tableOptions);
        $this->addPrimaryKey('item_id_key', '{{%item_field}}', [
            'item_id', 'key'
        ]);
        return true;
    }

    public function down()
    {
        $this->dropTable('{{%item_field}}');
        return true;
    }
}
