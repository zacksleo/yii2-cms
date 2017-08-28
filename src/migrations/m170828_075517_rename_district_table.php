<?php

use yii\db\Migration;

class m170828_075517_rename_district_table extends Migration
{
    public function up()
    {
        $this->renameTable('district', '{{%district}}');
    }

    public function down()
    {
        $this->renameTable('{{%district}}', 'district');
    }
}
