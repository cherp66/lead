<?php

namespace app\interfaces;

/**
 *
 */
interface RepositoryInterface
{
    /**
     *
     */
    public function addReady(string $ready): void;

    /**
     *
     */
    public function addFailed(string $failed): void;
    
    /**
     *
     */
    public function save(array $range): void;
    /**
     *
     */
    public function delete(): void;

}

