<?php

class m160519_165922_bill extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('bill', [
            'id' => $this->primaryKey(),
            'booking_identity' => $this->string()->notNull(),
            'created_at' => $this->integer(),
            'updated_at'=> $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('bill');
    }
}
