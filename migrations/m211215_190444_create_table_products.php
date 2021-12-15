<?php

use yii\db\Migration;

class m211215_190444_create_table_products extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(
            '{{%products}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string(100),
                'price' => $this->integer(),
                'onsale' => $this->integer(),
                'special_price' => $this->string(100),
            ],
            $tableOptions
        );

        $this->createIndex('products_id_IDX', '{{%products}}', ['id']);
    }

    public function down()
    {
        $this->dropTable('{{%products}}');
    }
}
