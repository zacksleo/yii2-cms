<?php

use yii\db\Migration;

/**
 * Handles the creation of table `menu`.
 */
class m170212_150618_create_menu_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%menu}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'order' => $this->smallInteger(),
            'parent' => $this->integer()->notNull()->defaultValue(0),
            'url' => $this->string()->notNull(),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('menu');
    }
}
