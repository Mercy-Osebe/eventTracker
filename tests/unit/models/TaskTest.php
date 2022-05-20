<?php

namespace tests\unit\models;

use app\models\Task;

//php vendor/bin/codecept run unit tests/unit/models/TaskTest
class TaskTest extends \Codeception\Test\Unit
{
    public function testStartWorks()
    {
        $task = new Task();
        $task->start();
        $reportStr = $task->report();
        $ar = explode(' ', $reportStr);
        $serversStarted = $ar[1];
        $this->assertEquals('12:00:00', $task->program_time);

        $this->assertEquals('START', $task->event);
        $this->assertEquals(
            'Start ' . $serversStarted . ' servers',
            $task->message
        );
        $this->assertGreaterThanOrEqual('10', $serversStarted);
        $this->assertLessThanOrEqual('20', $serversStarted);
    }

    public function testStopWorks()
    {
        $task = new Task();
        $task->start();
        $activeServerCountBeforeStop = $task->getActiveServersCount();
        $task->stop();
        $reportStr = $task->report();
        $ar = explode(' ', $reportStr);
        $activeServers = $ar[1];

        $this->assertGreaterThanOrEqual('0', $activeServers);

        $this->assertGreaterThanOrEqual('5', $task->getStopServersCount());
        $this->assertLessThanOrEqual(
            $activeServerCountBeforeStop,
            $task->getStopServersCount()
        );

        $this->assertEquals('STOP', $task->event);
        $this->assertEquals('12:00:40', $task->program_time);
    }

    public function testReportWorks()
    {
        $task = new Task();
        $result = $task->report();
        $this->assertEquals('Reported 0  running', $result);

        $this->setInterval(function() use ($task){
            $task->start();
        }, 30);


        $this->setInterval(function() use ($task){
            $task->stop();
        }, 40);


        $this->setInterval(function() use ($task){
            $task->report();
            $this->assertEquals('Reported 0  running', $task->report());
        }, 50);

       
    }

    function setInterval($f, $milliseconds)
    {
        $seconds = (int) $milliseconds / 1000;
        while (true) {
            $f();
            sleep($seconds);
        }
    }
}
