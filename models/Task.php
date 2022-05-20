<?php

namespace app\models;

use Exception;
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
    private $servers = 0;
    // $date = new DateTime();
    // $date = $date->format('h:i:s');
    // $date = strtotime($date);

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
            [
                [
                    'program_time',
                    'event',
                    'message',
                    'actual_time',
                    'display_message',
                ],
                'required',
            ],
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

    public function start()
    {
        $servers = rand(10, 20);
        $date = date('H:i:s');
        $startMessage = 'Start' . ' ' . $servers . ' ' . ' servers';

        $this->program_time = 345345445646576868;
        $this->event = 'START';
        $this->message = $startMessage;
        $this->actual_time = $date;
        $this->display_message = $date. ' '. $startMessage;
        $this->colors = '#fff';
        if($this->save())
        {
            $this->servers = $servers;
        }else{
            throw new Exception($this->errors());
        }
    }

    public function stop()
    {

        $serversToStop = rand(5, $this->servers);
        $this->servers = $this->servers - $serversToStop;

        $program_time = date('H:i:s');
        $actual_time = date('H:i:s');
        $stopMessage =
            'Stop' .$serversToStop .' servers';

        $this->program_time = $program_time;
        $this->event = 'STOP';
        $this->message = $stopMessage;
        $this->actual_time = $actual_time;
        $this->display_message = $actual_time.' '. $stopMessage;
        $this->colors = '#fff';
        if(!$this->save())
        {
            throw new Exception($this->errors()); 
        }
    }

    public function report()
    {
        $response =
            'Reported' . ' ' . $this->servers . ' ' . ' running';
        return $response;
    }
}
