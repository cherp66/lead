<?php

namespace app;

use LeadGenerator\Lead;
use app\delimiter\ports\GeneratorInterface;

use app\interfaces\{
    PoolInterface,
    ProcessorInterface,
    RepositoryInterface
};


/**
 *
 */
class Application
{  
    protected array $config;
    protected GeneratorInterface $generator;
    protected PoolInterface $pool;
    protected ProcessorInterface $processor;
    protected RepositoryInterface $repository;
    
    /**
     *
     */
    public function __construct(
        array $config, 
        GeneratorInterface $generator, 
        PoolInterface $pool,
        ProcessorInterface $processor,
        RepositoryInterface $repository
    ){
        $this->config = $config;
        $this->generator = $generator;
        $this->pool = $pool;    
        $this->processor = $processor;
        $this->repository = $repository;
    }

    /**
     * Старт
     */
    public function run() : void
    {
        $this->repository->delete();
        
        $this->generator->generateLeads($this->config['quantity'], function (Lead $lead) {
            $this->pool->add((array)$lead);
        });
     
        $this->processor->run($this->pool);        
    }
}
