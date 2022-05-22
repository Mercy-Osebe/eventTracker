<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'My Yii Application'; ?>
<div class="site-index"  >

    <div class="text-center bg-transparent" style="background-image:url('../pics/wall.png')">
        <div id="clockContainer">
            <div id="hour"></div>
            <div id="minute"></div>
            <div id="second"></div>
            <div id="pin"></div>
        </div>
    <?= Html::button('Report', ['class' => 'btn btn-primary','id' => 'report-id' ,'name' => 'contact-button']) ?>

    </div>

    <div id="report-result">

    </div>

</div>
