<?php

use yii\db\Migration;

class m160602_134052_cheapest extends Migration
{
    public function up()
    {
        $this->createTable('cheapest', [
            'id' => $this->primaryKey(),
            'from' => $this->string()->notNull(),
            'to' => $this->string()->notNull(),
            'date_depart' => $this->string(),
            'expect' => $this->integer(),
            'price' => $this->integer(),
            'source' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at'=> $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('cheapest');
    }
}
