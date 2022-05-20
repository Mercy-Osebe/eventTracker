<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "task".
 *
 * @property int $id
 * @property string $program_time
 * @property string $event
 * @property string $message
 * @property string $actual_time
 * @property string $display_message
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['program_time', 'event', 'message', 'actual_time', 'display_message'], 'required'],
            [['message', 'display_message'], 'string'],
            [['program_time', 'actual_time'], 'string', 'max' => 50],
            [['event'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'program_time' => 'Program Time',
            'event' => 'Event',
            'message' => 'Message',
            'actual_time' => 'Actual Time',
            'display_message' => 'Display Message',
        ];
    }
}
