<?php

use yii\db\Migration;

/**
 * Class m190118_191914_add_shop_product_additional_price_fields
 */
class m190118_191914_add_shop_product_additional_price_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%shop_products}}', 'price_min', $this->integer()->after('price_new'));
        $this->addColumn('{{%shop_products}}', 'price_roll', $this->integer()->after('price_min'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%shop_products}}', 'price_roll');
        $this->dropColumn('{{%shop_products}}', 'price_min');
    }
}
