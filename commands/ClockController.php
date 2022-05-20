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
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex()
    {
        echo "Beginning....\n";

        $task = new Task();

        $this->setInterval(function() use ($task){
            echo "Start job....\n";
            $task->start();
        }, 3000);


        $this->setInterval(function() use ($task){
            echo "Stop job....\n";
            $task->stop();
        }, 6000);

        return ExitCode::OK;
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
