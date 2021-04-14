<?php

use yii\db\Connection;

return [
    'class' => Connection::class,
    /** Тут host=percona - это контейнер с percona */
    'dsn' => 'mysql:host=percona;dbname=pilulka_testapp;',
    'username' => 'pilulka_testapp',
    'password' => 'pilulka_testapp',
    'charset' => 'utf8mb4',
];
