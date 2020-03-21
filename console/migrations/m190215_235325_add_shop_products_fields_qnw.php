<?php

use yii\db\Migration;

/**
 * Class m190215_235325_add_shop_products_fields_qnw
 */
class m190215_235325_add_shop_products_fields_qnw extends Migration
{
    public function up()
    {
        $this->addColumn('{{%shop_products}}', 'weight', $this->integer()->notNull());
        $this->addColumn('{{%shop_products}}', 'quantity', $this->integer()->notNull());
        $this->addColumn('{{%shop_modifications}}', 'quantity', $this->integer()->notNull());
    }

    public function down()
    {
        $this->dropColumn('{{%shop_modifications}}', 'quantity');
        $this->dropColumn('{{%shop_products}}', 'quantity');
        $this->dropColumn('{{%shop_products}}', 'weight');
    }
}
