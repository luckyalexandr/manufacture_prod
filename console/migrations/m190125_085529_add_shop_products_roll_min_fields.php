<?php

use yii\db\Migration;

/**
 * Class m190125_085529_add_shop_products_roll_min_fields
 */
class m190125_085529_add_shop_products_roll_min_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%shop_products}}', 'min_long', $this->smallInteger());
        $this->addColumn('{{%shop_products}}', 'roll_long', $this->smallInteger());

        $this->createIndex('{{%idx-shop_products-price_old}}', '{{%shop_products}}', 'price_old');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%shop_products}}', 'roll_long');
        $this->dropColumn('{{%shop_products}}', 'min_long');
    }
}
