<?php

use yii\db\Migration;

/**
 * Handles the creation of table `categories`.
 */
class m181120_070025_create_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('categories', [
            'id'          => $this->primaryKey(),
            'parent_id'   => $this->integer()->unsigned()->notNull()->defaultValue(0),
            'name'        => $this->string()->notNull(),
            'keywords'    => $this->string(),
            'description' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('categories');
    }
}
