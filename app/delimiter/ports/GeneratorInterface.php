<?php

namespace app\delimiter\ports;

/**
 *
 */
interface GeneratorInterface
{
    /**
     *
     */
    public function generateLeads(int $count, callable $leadHandler): void;
}

