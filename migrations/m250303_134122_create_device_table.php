<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%device}}`.
 */
class m250303_134122_create_device_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%device}}', [
            'id' => $this->primaryKey(),
            'other' => $this->boolean()->defaultValue(0),
            'user_id' => $this->integer()->null(),
            'name' => $this->string(256)->notNull(),
            'img' => $this->string(256)->null()->defaultValue('img/default.png'),
            'type_id' => $this->integer()->notNull(),
            'scenario_id' => $this->integer(),
        ]);

        $this->addForeignKey(
            'user_fk',
            '{{%device}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
        );

        $this->addForeignKey(
            'type_fk',
            '{{%device}}',
            'type_id',
            '{{%type}}',
            'id',
            'CASCADE',
        );

        $this->addForeignKey(
            'scenario_device_fk',
            '{{%device}}',
            'scenario_id',
            '{{%scenario}}',
            'id',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%device}}');
    }
}
