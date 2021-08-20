<?php

namespace app\interfaces;


/**
 *
 */
interface ProcessorInterface
{
    /**
     *
     */
    public function run(PoolInterface $pool): void;
}

