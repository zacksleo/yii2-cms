<?php

use yii\db\Migration;

/**
 * Handles the creation of table `district`.
 */
class m170828_075235_create_district_table extends Migration
{
    /**
     * @inheritdoc
     * @see https://github.com/eduosi/district/blob/master/district-standard.sql
     */
    public function up()
    {
        $this->execute(file_get_contents('https://raw.githubusercontent.com/eduosi/district/master/district-full.sql'));
        //$this->execute(file_get_contents('https://raw.githubusercontent.com/eduosi/district/master/district-standard.sql'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('district');
    }
}
