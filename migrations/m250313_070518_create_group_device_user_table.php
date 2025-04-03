<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%group_device_user}}`.
 */
class m250313_070518_create_group_device_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%group_device_user}}', [
            'id' => $this->primaryKey(),
            'device_user_id'=>$this->integer(),
            'group_id'=>$this->integer(),
        ]);

        $this->addForeignKey(
            'device_user_group_fk',
            '{{%group_device_user}}',
            'device_user_id',
            '{{%device_user}}',
            'id',
            'CASCADE',
        );
        $this->addForeignKey(
            'group_fk',
            '{{%group_device_user}}',
            'group_id',
            '{{%group}}',
            'id',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%group_device_user}}');
    }
}
