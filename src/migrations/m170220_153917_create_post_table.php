<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news`.
 */
class m170220_153917_create_post_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'image' => $this->string(),
            'content' => $this->text()->notNull(),
            'active' => $this->boolean()->notNull(),
            'source' => $this->string(),
            'visits' => $this->smallInteger(),
            'category_id' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);
        return true;
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%post}}');
        return true;
    }
}
