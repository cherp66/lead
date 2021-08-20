<?php

namespace app\delimiter;

use app\interfaces\RepositoryInterface;

/**
 *
 */
class Repository implements RepositoryInterface
{
    protected array $config;
    protected array $ready = [];
    protected array $failed = [];
    
    /**
     *
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    } 
    
    /**
     * Собирает обработанные заявки
     */
    public function addReady(string $ready): void
    {
        $this->ready[] = $ready . PHP_EOL;
    }    
    
    /**
     * Собирает необработанные заявки
     */
    public function addFailed(string $failed): void
    {
        $this->failed[] = $failed . PHP_EOL;
    }
    
    /**
     * Сохраняет данные в файлах
     */
    public function save(array $range): void
    {
        file_put_contents($this->config['ready'], $this->ready, FILE_APPEND);
        file_put_contents($this->config['failed'], $this->failed, FILE_APPEND);
        $meta = @file_get_contents($this->config['meta']);
        $meta = !empty($meta) ? json_decode($meta) : [];
        $meta[] = $range;
        file_put_contents($this->config['meta'], json_encode($meta));
        $this->ready = [];
        $this->failed = [];
    }
    
    /**
     * Удаляет все данные
     */
    public function delete(): void
    {
        file_put_contents($this->config['ready'],'');
        file_put_contents($this->config['failed'], '');
        file_put_contents($this->config['meta'], '');
    }
}
