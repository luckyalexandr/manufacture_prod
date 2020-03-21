<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_novetly`.
 */
class m190125_103533_create_shop_novetly_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_novetly}}', [
            'id' => $this->primaryKey(),
            'quantity' => $this->smallInteger()->notNull()->defaultValue(10),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop_novetly}}');
    }
}
