<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Event tracker'; ?>
<div class="site-index"  >

    <div class="text-center bg-manson-wall" id="clock-container">
        <div id="clockContainer">
            <div id="hour"></div>
            <div id="minute"></div>
            <div id="second"></div>
            <div id="pin"></div>
        </div>
        <?= Html::button('Report', ['class' => 'btn btn-primary','id' => 'report-id' ,'name' => 'contact-button']) ?>
    <?= Html::button('Clear report', ['class' => 'btn btn-danger','id' => 'clear-report-id' ,'name' => 'contact-button']) ?>

    </div>

    <div id="last-result">

    </div>

    <div id="report-result">

</div>

</div>
