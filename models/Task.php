<?php

namespace app\models;

use Exception;
use Yii;
use DateTime;

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
    private $serversToStop = 0;

    private $dateObj;

    function __construct()
    {
        $this->dateObj = new DateTime('2022-05-20 12:00:00');
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

        $program_time = $this->dateObj->format('H:i:s');
        $startMessage = 'Start ' . $servers . ' servers';

        $this->program_time = $program_time;
        $this->event = 'START';
        $this->message = $startMessage;
        $this->actual_time = date('H:i:s');
        $this->display_message = $program_time . ' ' . $startMessage;
        $this->colors = '#fff';
        if ($this->save()) {
            $this->servers = $servers;
        } else {
            throw new Exception(json_encode($this->getErrors()));
        }
    }

    public function stop()
    {
        $this->serversToStop = rand(5, $this->servers);

        $this->servers = $this->servers - $this->serversToStop;

        $program_time = $this->dateObj->modify('+40 seconds')->format('H:i:s');
        $actual_time = date('H:i:s');
        $stopMessage = 'Stop ' . $this->serversToStop . ' servers';

        $this->program_time = $program_time;
        $this->event = 'STOP';
        $this->message = $stopMessage;
        $this->actual_time = $actual_time;
        $this->display_message = $actual_time . ' ' . $stopMessage;
        $this->colors = '#fff';
        if (!$this->save()) {
            throw new Exception(json_encode($this->getErrors()));
        }
    }

    public function report()
    {

        $program_time = $this->dateObj->modify('+40 seconds')->format('H:i:s');
        $actual_time = date('H:i:s');
        $reportMessage = 'Report ' . $this->servers . ' servers running';
        $this->program_time = $program_time;
        $this->event = 'REPORT';
        $this->message = $reportMessage;
        $this->actual_time = $actual_time;
        $this->display_message = $actual_time . ' ' . $reportMessage;
        $this->colors = '#fff';
        if (!$this->save()) {
            throw new Exception(json_encode($this->getErrors()));
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
