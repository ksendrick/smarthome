<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%week}}`.
 */
class m250303_111055_create_week_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%week}}', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%week}}');
    }
}
