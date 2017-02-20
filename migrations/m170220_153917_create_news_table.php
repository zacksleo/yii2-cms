<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m170220_153917_create_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%news}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'image' => $this->string(),
            'content' => $this->text()->notNull(),
            'active' => $this->boolean()->notNull(),
            'source' => $this->string(),
            'visits' => $this->smallInteger(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%news}}');
    }
}
