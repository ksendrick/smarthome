<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%scenario_user}}`.
 */
class m250303_115035_create_scenario_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%scenario_user}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer(),
            'scenario_id'=>$this->integer(),
            'name' => $this->string(256),
            'time_on' => $this->time(),
            'time_off' => $this->time(),
            'brightness' => $this->integer(),
            'week_id' => $this->integer(),
            'type_id' => $this->integer(),
        ]);

        $this->addForeignKey(
            'scenario_user_fk',
            '{{%scenario_user}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE',
        );

        $this->addForeignKey(
            'scenario_fk',
            '{{%scenario_user}}',
            'scenario_id',
            '{{%scenario}}',
            'id',
            'CASCADE',
        );

        $this->addForeignKey(
            'week_user_fk',
            '{{%scenario_user}}',
            'week_id',
            '{{%week}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'type_scenario_user_fk',
            '{{%scenario_user}}',
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
        $this->dropTable('{{%scenario_user}}');
    }
}
