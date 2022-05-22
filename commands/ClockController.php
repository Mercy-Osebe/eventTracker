<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Task;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ClockController extends Controller
{

    private $secondElapsed = 0;
    private $task;


    private static $START_INTERVAL = 3;
    private static $STOP_INTERVAL = 4;
    private static $REPORT_INTERVAL = 5;

    function backGround()
    {
        echo "secondElapsed....".$this->secondElapsed."\n"; 

        $this->secondElapsed++;

        if ($this->secondElapsed % self::$START_INTERVAL == 0 && $this->secondElapsed % self::$STOP_INTERVAL == 0 && $this->secondElapsed % self::$REPORT_INTERVAL == 0) {
            echo "Start stop report coinciding.\n";
            $this->task->start();
            $this->task->stop();
            $this->task->report();
        } else if ($this->secondElapsed % self::$START_INTERVAL == 0 && $this->secondElapsed % self::$STOP_INTERVAL == 0) {
            echo "Start stop coinciding.\n";
            $this->task->start();
            $this->task->stop();
        } else if ($this->secondElapsed % self::$START_INTERVAL == 0 && $this->secondElapsed % self::$REPORT_INTERVAL == 0) {
            echo "Start report coinciding.\n";
            $this->task->start();
            $this->task->report();
        }  else if ($this->secondElapsed % self::$STOP_INTERVAL == 0 && $this->secondElapsed % self::$REPORT_INTERVAL == 0) {
            echo "Stop report coinciding.\n";
            $this->task->stop();
            $this->task->report();
        } else if ($this->secondElapsed % self::$START_INTERVAL == 0) {
            echo "Starting job....\n";
            $this->task->start();
        } else if ($this->secondElapsed % self::$STOP_INTERVAL == 0) {
            echo "Stoping job....\n";
            $this->task->start();
        } else if ($this->secondElapsed % self::$REPORT_INTERVAL == 0) {
            echo "Reporting job....\n";
            $this->task->start();
        }
    }
    
    
    public function actionIndex()
    {
        echo "Beginning....\n";

        
        $this->task =new Task();
        $this->secondElapsed = 0;
        $milliseconds = 1000;
        $seconds = (int) $milliseconds / 1000;
        while (true) {
            $this->backGround();
            sleep($seconds);
        }

        return ExitCode::OK;
    }
    
}
