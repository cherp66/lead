<?php

    require __DIR__ . '/vendor/autoload.php';
    $config = include __DIR__ .'/resources/config.php';
    (new \app\composition\Assembler($config))->appRun();