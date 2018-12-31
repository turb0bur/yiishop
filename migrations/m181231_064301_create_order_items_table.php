<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_items`.
 */
class m181231_064301_create_order_items_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('order_items', [
            'id'           => $this->primaryKey(),
            'order_id'     => $this->integer()->unsigned()->notNull(),
            'product_id'   => $this->integer()->unsigned()->notNull(),
            'product_name' => $this->string()->notNull(),
            'quantity'     => $this->integer()->notNull(),
            'price'        => $this->float()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('order_items');
    }
}
