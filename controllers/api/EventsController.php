<?php

namespace app\controllers\api;

use app\models\Task;
use Yii;
use yii\rest\Controller;

class EventsController extends Controller
{

    public function actionReport(){
        return Task::find()->all();
    }

}
