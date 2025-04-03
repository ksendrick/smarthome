<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notification}}`.
 */
class m250311_083535_create_notification_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notification}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'device_user_id' => $this->integer()->notNull(),
            'message' => $this->string()->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'is_read' => $this->boolean()->defaultValue(0),
        ]);

        $this->addForeignKey(
            'user_not_fk',
            '{{%notification}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'device_user_not_fk',
            '{{%notification}}',
            'device_user_id',
            '{{%device_user}}',
            'id',
            'CASCADE'
        );


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%notification}}');
    }
}
