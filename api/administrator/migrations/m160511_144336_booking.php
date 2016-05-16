<?php

class m160511_144336_booking extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('booking', [
            'id' => $this->primaryKey(),
            'identity' => $this->string(),
            'round_trip' => $this->integer()->defaultValue(0),
            'tickets' => $this->text()->notNull(),
            'passengers' => $this->text()->notNull(),
            'adult' => $this->integer()->defaultValue(0),
            'child' => $this->integer()->defaultValue(0),
            'infant' => $this->integer()->defaultValue(0),
            'payment' => $this->string(),
            'options' => $this->text(),
            'contact_name' => $this->string(),
            'contact_phone' => $this->string(),
            'contact_email' => $this->string(),
            'price' => $this->integer()->notNull(),
            'status' => $this->integer()->defaultValue(0),
            'created_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at'=> $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('booking');
    }
}
