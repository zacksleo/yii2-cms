<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post`.
 */
class m170917_140443_create_page_table extends Migration
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
        $this->createTable('{{%page}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->comment('标题'),
            'slug' => $this->string()->notNull()->comment('别名'),
            'status' => $this->boolean()->defaultValue(1),
            'content' => $this->text()->comment('内容'),
            'created_at' => $this->integer()->notNull()->comment('创建时间'),
            'updated_at' => $this->integer()->notNull()->comment('更新时间'),
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%page}}');
    }
}
