<?php

namespace app\process;

use app\interfaces\{
    WorkerInterface,
    RepositoryInterface
};

/**
 *
 */
class Worker implements WorkerInterface
{
    protected RepositoryInterface $repository;

    /**
     *
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    
    /**
     * Обработка и запись в репозиторий
     */
    public function run(string $file): void
    {
        $data = $this->getData($file);
     
        foreach($data as $lead){
            try{
                $this->repository->addReady($this->process($lead));
            } catch (\RuntimeException $e){
                $this->repository->addFailed($e->getMessage());
            }
        }
        
        $this->repository->save([array_shift($data)['id'], array_pop($data)['id']]);
        unlink($file);
    }
    
    /**
     *
     */
    protected function getData(string $file): array
    {
        $data = @file_get_contents($file);
        return json_decode($data, true);        
    }    
    
    /**
     *
     */
    protected function process(array $lead): string
    {
        // Эмуляция тяжелой обработки
        sleep(2);
        // Эмуляция необработанных заявок
        if(100 === rand(0, 200)) {
            throw new \RuntimeException($lead['id']);
        }
        return $this->prepare($lead);
    }
    
    /**
     *
     */
    protected function prepare($lead): string
    {
        return $lead['id'] .' | '. $lead['categoryName'] .' | '. date('Y-m-d h:i:s');
    }
}
