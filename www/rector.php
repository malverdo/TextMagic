<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\ValueObject\PhpVersion;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/config',
        __DIR__ . '/public',
        __DIR__ . '/src',
    ])
    ->withSets([
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        SetList::NAMING,
        SetList::PHP_80,          // Правила для обновления до PHP 8.0
        SetList::PHP_81,          // Правила для обновления до PHP 8.1
        SetList::PRIVATIZATION,   // Приватизация методов и свойств, где это возможно
        SetList::TYPE_DECLARATION // Добавление недостающих типовых аннотаций
    ])
    ->withPhpVersion(PhpVersion::PHP_81);
