<?php

class m160429_081545_create_user extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'role' => $this->string()->notNull(),
            'password_hash' => $this->text()->notNull(),
            'auth_key' => $this->string()->notNull(),
            'rate_limit' => $this->integer()->defaultValue(100),
            'allowance' => $this->integer()->defaultValue(100),
            'allowance_updated_at' => $this->integer(),
            'access_token' => $this->text()->notNull(),
            'created_at' => $this->integer(),
            'updated_at'=> $this->integer(),
            'last_used'=> $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('user');
    }
}
