<?php

class m160429_082930_create_panel extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('panel', [
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
        $this->dropTable('panel');
    }
}
