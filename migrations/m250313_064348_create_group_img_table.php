<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%group_img}}`.
 */
class m250313_064348_create_group_img_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%group_img}}', [
            'id' => $this->primaryKey(),
            'img'=>$this->string(256)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%group_img}}');
    }
}
