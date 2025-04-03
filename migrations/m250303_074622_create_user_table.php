<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m250303_074622_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username'=>$this->string(256)->unique()->notNull(),
            'password'=>$this->string(256)->notNull(),
            'name'=>$this->string(256)->notNull(),
            'surname'=>$this->string(256)->notNull(),
            'patronymic'=>$this->string(256)->null(),
            'email'=>$this->string(256)->unique()->notNull(),
            'is_admin'=>$this->boolean()->defaultValue(0),
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
