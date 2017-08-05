<?php

use yii\db\Migration;

/**
 * Handles the creation of table `links`.
 */
class m170212_062736_create_links_table extends Migration
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
        $this->createTable('{{%links}}', [
            'id' => $this->primaryKey(),
            'category' => $this->string(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
            'url' => $this->string()->notNull(),
            'logo' => $this->string(),
            'order' => $this->integer(5)->defaultValue(0),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
        ], $tableOptions);
        return true;
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%links}}');
        return true;
    }
}
