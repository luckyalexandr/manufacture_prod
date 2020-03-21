<?php

use yii\db\Migration;

/**
 * Class m190316_233114_add_created_at_fields
 */
class m190316_233114_add_created_at_fields extends Migration
{
    public function up()
    {
        $this->addColumn('{{%blog_categories}}', 'created_at', $this->integer()->unsigned()->notNull());
        $this->addColumn('{{%shop_categories}}', 'created_at', $this->integer()->unsigned()->notNull());
        $this->addColumn('{{%pages}}', 'created_at', $this->integer()->unsigned()->notNull());
    }

    public function down()
    {
        $this->dropColumn('{{%blog_categories}}', 'created_at');
        $this->dropColumn('{{%shop_categories}}', 'created_at');
        $this->dropColumn('{{%pages}}', 'created_at');
    }
}
