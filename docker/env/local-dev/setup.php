<?php

require __DIR__ . '/../Builder.php';

/**
 * Создание нужных директорий
 */
Builder::createDirectoryIfNotExists(__DIR__ . '/../../../app/public');
Builder::createDirectoryIfNotExists(__DIR__ . '/../../../app/public/assets');
Builder::createDirectoryIfNotExists(__DIR__ . '/../../../app/public/uploads');
Builder::createDirectoryIfNotExists(__DIR__ . '/../../../app/runtime');

/**
 * Копирование конфигов из ./config в соответствующую
 * директорию в проекте. Одним словом - МИГРАЦИЯ_КОНФИГУРАЦИИ
 */
Builder::copyFilesFromDirToDir(
    __DIR__ . '/config',
    __DIR__ . '/../../../app/config',
    'start copying configuration files'
);

/**
 * Копирование публичных файлов
 */
Builder::copyFilesFromDirToDir(
    __DIR__ . '/public',
    __DIR__ . '/../../../app/public',
    'start copying public files'
);

/**
 * Копирование файла .env
 */
Builder::copyFile(__DIR__ . '/.env.dist', __DIR__ . '/.env');