<?php

    $basePath = dirname(__DIR__ , 2);
    require $basePath .'/vendor/autoload.php';
    $config = include $basePath  .'/resources/config.php';
    (new \app\composition\Assembler($config))->appRun();
    
    $cmd = new \app\cli\Cmd;
    $cmd->phrase('Идет процесс обработки.');
    $start = time();
    $cnt = $alarm = 0;    

    while(true){
        $cnt++;
        $alarm++;
        $cmd->createBar($cnt);
        sleep(1);
        if($cnt > 15){
            $cnt = 0;
            if(count(scandir(\app\process\Pool::DIR_POOL)) === 2)
            {
                $cmd->end('Готово. Затрачено минут: '. round((time() - $start) / 60, 1));
                break;
            }
        }
    
        if($alarm > 600)
        {
            $cmd->end('Что то не так. Затрачено больше 10 минут. Проверьте метаданные или увеличте число потоков.');            
            break;
        }    
    }