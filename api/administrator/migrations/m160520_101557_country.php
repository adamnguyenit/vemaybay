<?php

class m160520_101557_country extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('country', [
            'id' => $this->primaryKey(),
            'country_code' => $this->string(),
            'country_name' => $this->string(),
            'region_name' => $this->string(),
            'city_name' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at'=> $this->integer(),
        ]);
    }

    public function down()
    {
        $this->dropTable('country');
    }
}
