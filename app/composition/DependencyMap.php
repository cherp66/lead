<?php 

namespace app\composition;

use app\Application;
use Chsoft\Dic\Container;
use app\delimiter\GeneratorAdapter as Generator;
use app\delimiter\{
    Repository
};    
use app\process\{
    Pool,
    Processor,
    Worker    
};

/**
 *                    
 */
class DependencyMap
{
    public static function get(array $config) : array
    {
        return [
         
            Container::DEFAULT_SERVICE => [
                'config' => function () use ($config) { return $config; },
            ],            
            
            'App' => [
                Application::class,
                    'generator'  => Generator::class,
                    'pool'       => 'Pool',
                    'processor'  => Processor::class,
                    'repository' => 'Repository',
            ],
            
            'Worker' => [
                Worker::class,
                    'config' => false,
                    'repository' => 'Repository'                    
            ], 
            
            'Pool'   => Pool::class,
            'Repository' =>  Repository::class,

         
        ];    
    }
}

