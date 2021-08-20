<?php

namespace app\delimiter;

use LeadGenerator\Generator;
use app\delimiter\ports\GeneratorInterface;

/**
 *
 */
class GeneratorAdapter extends Generator implements GeneratorInterface
{
    public function generateLeads(int $count, callable $leadHandler): void
    {
        parent::generateLeads($count, $leadHandler);
    }
}

