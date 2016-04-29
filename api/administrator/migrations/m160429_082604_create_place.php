<?php

class m160429_082604_create_place extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('place', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'english_name' => $this->string(),
            'country_code' => $this->string(),
            'airport_name' => $this->string(),
            'support_jetstar' => $this->integer()->defaultValue(0),
            'support_vietjetair' => $this->integer()->defaultValue(0),
            'support_vietnamairline' => $this->integer()->defaultValue(0),
            'order' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at'=> $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('place');
    }
}
