<?php

use yii\db\Migration;

/**
 * Class m190114_185442_add_shop_product_description_field
 */
class m190114_185442_add_shop_product_description_field extends Migration
{
    public function up()
    {
        $this->addColumn('{{%shop_products}}', 'description', $this->text()->after('name'));
    }

    public function down()
    {
        $this->dropColumn('{{%shop_products}}', 'description');
    }
}
