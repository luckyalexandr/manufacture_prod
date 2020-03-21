<?php

use yii\db\Migration;

/**
 * Handles the creation of table `shop_main_banner`.
 */
class m190125_103625_create_shop_main_banner_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('{{%shop_main_banner}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'text' => $this->string(),
            'image' => $this->string()->notNull(),
            'link' => $this->string(),
            'sort' => $this->smallInteger(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop_main_banner}}');
    }
}
