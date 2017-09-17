<?php

use yii\db\Migration;

/**
 * Handles the creation of table `post_tag_assn`.
 */
class m170917_075436_create_post_tag_assn_table extends Migration
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
        $this->createTable('{{%post_tag_assn}}', [
            'post_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
        ], $tableOptions);
        $this->addPrimaryKey('', '{{%post_tag_assn}}', ['post_id', 'tag_id']);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%post_tag_assn}}');
    }
}
