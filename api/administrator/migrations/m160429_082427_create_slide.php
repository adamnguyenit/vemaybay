<?php

class m160429_082427_create_slide extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('slide', [
            'id' => $this->primaryKey(),
            'index' => $this->integer(),
            'image' => $this->string(),
            'link' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at'=> $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('slide');
    }
}
