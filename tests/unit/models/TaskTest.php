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
        // $this->assertEquals('12:00.00', $task->program_time);
        $this->assertEquals('START', $task->event);
        $this->assertEquals('Start '.$serversStarted.' servers', $task->message);
        $this->assertGreaterThanOrEqual('10', $serversStarted);
        $this->assertLessThanOrEqual('20', $serversStarted);
    }

    public function testStopWorks()
    {
        // expect_that($user = User::findIdentity(100));
        // expect($user->username)->equals('admin');

        // expect_not(User::findIdentity(999));
    }

    public function testReportWorks()
    {
        // expect_that($user = User::findIdentity(100));
        // expect($user->username)->equals('admin');

        // expect_not(User::findIdentity(999));
    }
}
