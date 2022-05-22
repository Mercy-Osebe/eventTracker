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
    private $servers = 0; // active servers
    private $serversToStop = 0; // no of servers to stop


    private static $START_COLOR = 'green';
    private static $STOP_COLOR = 'red';
    private static $REPORT_COLOR = 'blue';
   

    function __construct()
    {
        
    }
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
        $startMessage = 'Start ' . $servers . ' servers';

        // $this->program_time = $program_time;
        // $this->event = 'START';
        // $this->message = $startMessage;
        // $this->actual_time = date('H:i:s');
        // $this->display_message = $program_time . ' ' . $startMessage;
        // $this->colors = '#fff';
        // if ($this->save()) {
        //     $this->servers = $servers;
        // } else {
        //     throw new Exception(json_encode($this->getErrors()));
        // }

        $newTask = new Task();
        $newTask->program_time = $this->program_time;
        $newTask->event = 'START';

        $newTask->message = $startMessage;
        
        $newTask->actual_time = date('H:i:s');
        $newTask->display_message = $this->program_time. ' ' . $startMessage;
        $newTask->colors = self::$START_COLOR;
        if ($newTask->save()) {
            $this->servers = $this->servers + $servers;
            echo $newTask->display_message;
        } else {
            throw new Exception(json_encode($newTask->getErrors()));
        }

        return $startMessage;
    }

    public function stop()
    {
        $this->serversToStop = rand(5, $this->servers);

        $this->servers = $this->servers - $this->serversToStop;

        $actual_time = date('H:i:s');
        $stopMessage = 'Stop ' . $this->serversToStop . ' servers';

        $newTask = new Task();

        $newTask->program_time = $this->program_time;
        $newTask->event = 'STOP';
        $newTask->message = $stopMessage;
        $newTask->actual_time = $actual_time;
        $newTask->display_message = $this->program_time. ' ' . $stopMessage;
        $newTask->colors = self::$STOP_COLOR;
        if (!$newTask->save()) {
            throw new Exception(json_encode($newTask->getErrors()));
        } else {
            echo $newTask->display_message;
        }
    }

    public function report()
    {
        $actual_time = date('H:i:s');
        $reportMessage = 'Report ' . $this->servers . ' servers running';

        $newTask = new Task();
        $newTask->program_time = $this->program_time;
        $newTask->event = 'REPORT';
        $newTask->message = $reportMessage;
        $newTask->actual_time = $actual_time;
        $newTask->display_message = $this->program_time . ' ' . $reportMessage;
        $newTask->colors = self::$REPORT_COLOR;
        if (!$newTask->save()) {
            throw new Exception(json_encode($newTask->getErrors()));
        } else {
            echo $newTask->display_message;
        }

        $response = 'Reported' . ' ' . $this->servers . ' ' . ' running';
        return $response;
    }

    public function getStopServersCount()
    {
        return $this->serversToStop;
    }

    public function getActiveServersCount()
    {
        return $this->servers;
    }
}
