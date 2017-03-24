<?php

use yii\db\Migration;

class m170325_133653_add_column_status_to_order_table extends Migration
{
    public function up()
    {
        $this->addColumn('order', 'status', $this->string(25)->notNull());

        return true;
    }

    public function down()
    {
        $this->dropColumn('order', 'status');
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
