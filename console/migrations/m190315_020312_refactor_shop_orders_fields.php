<?php

use yii\db\Migration;

/**
 * Class m190315_020312_refactor_shop_orders_fields
 */
class m190315_020312_refactor_shop_orders_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%shop_orders}}', 'delivery_index');
        $this->addColumn('{{%shop_orders}}', 'delivery_area', $this->string()->after('delivery_address'));
        $this->addColumn('{{%shop_orders}}', 'delivery_city', $this->string()->after('delivery_area'));
        $this->addColumn('{{%shop_orders}}', 'delivery_warehouse', $this->string()->after('delivery_city'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190315_020312_refactor_shop_orders_fields cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190315_020312_refactor_shop_orders_fields cannot be reverted.\n";

        return false;
    }
    */
}
