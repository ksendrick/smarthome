<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%scenario}}`.
 */
class m250303_114529_create_scenario_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%scenario}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(256),
            'time_on' => $this->time(),
            'time_off' => $this->time(),
            'brightness' => $this->integer(),
            'week_id' => $this->integer(),
            'type_id' => $this->integer(),
        ]);

        $this->addForeignKey(
            'week_fk',
            '{{%scenario}}',
            'week_id',
            '{{%week}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'type_scenario_fk',
            '{{%scenario}}',
            'type_id',
            '{{%type}}',
            'id',
            'CASCADE'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%scenario}}');
    }
}
