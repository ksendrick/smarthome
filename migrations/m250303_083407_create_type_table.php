<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%type}}`.
 */
class m250303_083407_create_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%type}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(256)->notNull(),
            'img'=>$this->string(256)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%type}}');
    }
}
