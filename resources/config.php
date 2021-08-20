<?php

return [
/* Пути, куда записвать данные */  
    'ready' => dirname(__DIR__, 1) .'/data/log.txt', // Обработанные
    'failed' => dirname(__DIR__, 1) .'/data/failed.txt', // Не прошедшие
    'meta' => dirname(__DIR__, 1) .'/data/meta.txt', // Метаданные на случай сбоя
/* Системные настройки */
    'quantity' => 10000, // Количество заявок
    'task_count' => 35, // Количество потоков (задач)
];
