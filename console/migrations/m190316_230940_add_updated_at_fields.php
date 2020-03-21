<?php

use yii\db\Migration;

/**
 * Class m190316_230940_add_updated_at_fields
 */
class m190316_230940_add_updated_at_fields extends Migration
{
    public function up()
    {
        $this->addColumn('{{%blog_categories}}', 'updated_at', $this->integer()->unsigned()->notNull());
        $this->addColumn('{{%blog_posts}}', 'updated_at', $this->integer()->unsigned()->notNull());
        $this->addColumn('{{%shop_categories}}', 'updated_at', $this->integer()->unsigned()->notNull());
        $this->addColumn('{{%shop_products}}', 'updated_at', $this->integer()->unsigned()->notNull());
        $this->addColumn('{{%pages}}', 'updated_at', $this->integer()->unsigned()->notNull());
    }

    public function down()
    {
        $this->dropColumn('{{%blog_categories}}', 'updated_at');
        $this->dropColumn('{{%blog_posts}}', 'updated_at');
        $this->dropColumn('{{%shop_categories}}', 'updated_at');
        $this->dropColumn('{{%shop_products}}', 'updated_at');
        $this->dropColumn('{{%pages}}', 'updated_at');
    }
}
