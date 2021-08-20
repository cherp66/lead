<?php

    ignore_user_abort(true);
    set_time_limit(0);
    
    $basePath = dirname(__DIR__ , 2);
    require $basePath .'/vendor/autoload.php';
    $config = include $basePath  .'/resources/config.php';
    (new \app\composition\Assembler($config))->workerRun($file ?: $argv[1]);    