<?php

class m160516_104135_baggage extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('baggage', [
            'id' => $this->primaryKey(),
            'airline' => $this->string(),
            'code' => $this->string(),
            'price' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at'=> $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('baggage');
    }
}
