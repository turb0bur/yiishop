<?php

use yii\db\Migration;

/**
 * Handles the creation of table `products`.
 */
class m181120_071734_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('products', [
            'id'          => $this->primaryKey(),
            'category_id' => $this->integer()->unsigned()->notNull(),
            'name'        => $this->string()->notNull(),
            'content'     => $this->string(),
            'price'       => $this->float()->notNull()->defaultValue(0),
            'keywords'    => $this->string(),
            'description' => $this->string(),
            'image'       => $this->string()->defaultValue('no-image.png'),
            'hit'         => 'ENUM("0", "1") NOT NULL DEFAULT "0"',
            'new'         => 'ENUM("0", "1") NOT NULL DEFAULT "0"',
            'sale'        => 'ENUM("0", "1") NOT NULL DEFAULT "0"',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('products');
    }
}
