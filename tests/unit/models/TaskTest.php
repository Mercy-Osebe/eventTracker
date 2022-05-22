<?php

namespace tests\unit\models;

use app\models\Task;
use DateTime;

//php vendor/bin/codecept run unit tests/unit/models/TaskTest
class TaskTest extends \Codeception\Test\Unit
{

    private $dateObj;
    protected $tester;

    protected function _before()
    {
        $this->dateObj = new DateTime('2022-05-20 12:00:00');
        
    }

    public function testStartWorks()
    {
        $task = new Task();
        $task->program_time = $this->dateObj->modify('+30 seconds')->format('H:i:s');
        $msg = $task->start();
        $this->assertEquals('12:00:30', $task->program_time);
        // $this->tester->seeInDatabase('task', ['event' => 'START']);
        $this->assertEquals(
            'Start ' . $task->getActiveServersCount() . ' servers',
            $msg
        );
        $task->program_time = $this->dateObj->modify('+50 seconds')->format('H:i:s');
        $reportStr = $task->report();
        $ar = explode(' ', $reportStr);
        $serversStarted = $ar[1];
        

      
       
        $this->assertGreaterThanOrEqual('10', $serversStarted);
        $this->assertLessThanOrEqual('20', $serversStarted);
    }

    public function testStopWorks()
    {
        $task = new Task();

        $task->program_time = $this->dateObj->modify('+30 seconds')->format('H:i:s');
        $task->start();
        $activeServerCountBeforeStop = $task->getActiveServersCount();
        $this->assertEquals('12:00:30', $task->program_time);
        $task->program_time = $this->dateObj->modify('+40 seconds')->format('H:i:s');
        $task->stop();
        $this->assertEquals('12:01:10', $task->program_time);
        $task->program_time = $this->dateObj->modify('+50 seconds')->format('H:i:s');
        $reportStr = $task->report();
        $this->assertEquals('12:02:00', $task->program_time);
        $ar = explode(' ', $reportStr);
        $activeServers = $ar[1];

        $this->assertGreaterThanOrEqual('0', $activeServers);

        $this->assertGreaterThanOrEqual('5', $task->getStopServersCount());
        $this->assertLessThanOrEqual(
            $activeServerCountBeforeStop,
            $task->getStopServersCount()
        );

        
    }

    public function testReportWorks()
    {
        $task = new Task();
        $task->program_time = $this->dateObj->modify('+50 seconds')->format('H:i:s');
        $result = $task->report();
        $this->assertEquals('Reported 0  running', $result);
       
    }
}
