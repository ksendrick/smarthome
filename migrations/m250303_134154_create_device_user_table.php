<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%device_user}}`.
 */
class m250303_134154_create_device_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%device_user}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer()->notNull(),
            'device_id'=>$this->integer()->notNull(),
            'is_click'=>$this->boolean()->defaultValue(0),
            'click_time' => $this->timestamp()->null(),
            'time_on'=>$this->time()->null(),
            'time_off'=>$this->time()->null(),
            'status'=>$this->boolean()->defaultValue(0),
            'read_at'=>$this->timestamp(),
        ]);

        $this->addForeignKey(
            'device_user_fk',
            '{{%device_user}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
        );

        $this->addForeignKey(
            'device_fk',
            '{{%device_user}}',
            'device_id',
            '{{%device}}',
            'id',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%device_user}}');
    }
}
