<?php

use yii\db\Connection;

return [
    'class' => Connection::class,
    /** Тут host=percona - это контейнер с percona */
    'dsn' => 'mysql:host=percona;dbname=pilulka_testapp;',
    'username' => 'pilulka_testapp',
    'password' => 'dffa1e239c53dec9bb2b2d19852dccc60f0f75',
    'charset' => 'utf8mb4',
];
