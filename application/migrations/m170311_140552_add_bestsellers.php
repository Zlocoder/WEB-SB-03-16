<?php

use yii\db\Migration;

class m170311_140552_add_bestsellers extends Migration
{
    public function up()
    {
        $this->addColumn('product', 'bestseller', $this->boolean()->notNull());
        return true;
    }

    public function down()
    {
        $this->dropColumn('product', 'bestseller');
        return true;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
