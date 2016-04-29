<?php

class m160429_080829_create_news extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('news', [
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
        $this->dropTable('news');
    }
}
