<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%task}}`.
 */
class m220520_142903_create_task_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%task}}', [
            'id' => $this->primaryKey(),
            'program_time' => $this->string(50)->notNull(),
            'event' => $this->string(10)->notNull(),
            'message' => $this->text()->notNull(),
            'actual_time' => $this->string(50)->notNull(),
            'display_message' => $this->text()->notNull(),
            'colors' => $this->string(10)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%task}}');
    }
}
