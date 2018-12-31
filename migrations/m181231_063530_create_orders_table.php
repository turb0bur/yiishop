<?php

use yii\db\Migration;

/**
 * Handles the creation of table `orders`.
 */
class m181231_063530_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('orders', [
            'id'         => $this->primaryKey(),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
            'quantity'   => $this->integer()->notNull(),
            'total'      => $this->float()->notNull(),
            'status'     => 'ENUM("0", "1") NOT NULL DEFAULT "0"',
            'name'       => $this->string()->notNull(),
            'email'      => $this->string()->notNull(),
            'phone'      => $this->string()->notNull(),
            'address'    => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('orders');
    }
}
