<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%group}}`.
 */
class m250313_065811_create_group_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%group}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string(256),
            'group_img_id' => $this->integer(),
        ]);

        $this->addForeignKey(
            'user_fk_group',
            '{{%group}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'group_img_fk',
            '{{%group}}',
            'group_img_id',
            '{{%group_img}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%group}}');
    }
}
