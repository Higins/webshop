<?php

use yii\db\Migration;

class m211215_190427_create_table_coupon extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%coupon}}',
            [
                'id' => $this->primaryKey(),
                'coupon_name' => $this->string(100),
                'coupon_discount' => $this->integer(),
                'valid' => $this->integer(),
                'valid_from' => $this->date(),
                'valid_to' => $this->date(),
            ],
            $tableOptions
        );
    }

    public function down()
    {
        $this->dropTable('{{%coupon}}');
    }
}
