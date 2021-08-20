<?php

namespace app\interfaces;


/**
 *
 */
interface WorkerInterface
{
    /**
     *
     */
    public function run(string $file): void;
}

