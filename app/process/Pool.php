<?php

namespace app\process;

use app\interfaces\PoolInterface;

/**
 *
 */
class Pool implements PoolInterface
{
    protected array $config;
    protected int $cnt = 0;
    protected int $maxShunk = 1;
    protected array $shunk = [];
    protected array $files = [];
    
    const DIR_POOL = __DIR__ .'/tmp';
    const EXT = '.pool';
    
    /**
     *
     */
    public function __construct(array $config)
    {
        $this->config = $config;
        $cnt = $this->config['task_count'] ?: 1;
        $this->maxShunk = round($this->config['quantity'] / abs($cnt));
        
        if(!is_dir(self::DIR_POOL)){
            mkdir(self::DIR_POOL, 0755);
        }
    } 

    /**
     * Добавляет заявки партиями для экономии памяти
     */
    public function add(array $lead): void
    {
        $this->shunk[] = $lead;
        if(count($this->shunk) === (int)$this->maxShunk){
            $this->save();
            $this->shunk = [];
        }
    }    
    
    /**
     * Записывает партию заявок во временные файлы
     */
    public function save(): void
    {
        $file = self::DIR_POOL .'/'. (++$this->cnt) . self::EXT;
        file_put_contents($file, json_encode($this->shunk));        
        $this->files[] = $file;
    }
    
    /**
     * Возвращает пути до временных файлов
     */
    public function getFiles(): \Generator
    {
        if(count($this->shunk) > 0) {
            $this->save();
        }
        
        while($file = array_shift($this->files)){
           yield $file;
        }
    }
}
