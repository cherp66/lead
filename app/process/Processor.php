<?php

namespace app\process;

use app\interfaces\{
    PoolInterface,
    ProcessorInterface
};

/**
 *
 */
class Processor implements ProcessorInterface
{
    /**
     * Запуск фоновых процессов
     */
    public function run(PoolInterface $pool): void
    {
        $cli = dirname(__DIR__, 1) .'/cli/workers.php';
        foreach($pool->getFiles() as $file) {
            $cmd = $this->isWindows() ? 
                'start /b php '. $cli .' "'. $file .'" 2>&1'
              : 'nice php '. $cli .'"'. $file .'" 2>&1 & echo $!';
             
            pclose(popen($cmd, 'r'));
            usleep(10000);
        }
    }
    
    /**
     * Определение ОС
     */
    protected function isWindows(): bool
    {
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }
}
