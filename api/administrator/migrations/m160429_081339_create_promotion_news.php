<?php

class m160429_081339_create_promotion_news extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('promotion_news', [
            'id' => $this->primaryKey(),
            'alias' => $this->string(),
            'title' => $this->string()->notNull(),
            'content' => $this->text(),
            'views' => $this->integer()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at'=> $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('promotion_news');
    }
}
