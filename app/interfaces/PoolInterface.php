<?php

namespace app\interfaces;

/**
 *
 */
interface PoolInterface
{
    /**
     *
     */
    public function add(array $lead): void;    
    
    /**
     *
     */
    public function save(): void;
    
    /**
     *
     */
    public function getFiles();
}

