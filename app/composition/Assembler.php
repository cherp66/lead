<?php

namespace app\composition;

use Chsoft\Dic\Container;

/**
 *
 */
class Assembler
{
    private Container $container;

    /**
     *
     */
    public function __construct(array $config)
    {
        $this->container = new Container;
        $this->container->add(DependencyMap::get($config));
    }
    
    /**
     *
     */
    public function appRun()
    {
        $app = $this->container->get('App');     
        $app->run(); 
    }
    
    /**
     *
     */
    public function workerRun(string $file): void
    {
        $worker = $this->container->get('Worker');     
        $worker->run($file); 
    }
}
