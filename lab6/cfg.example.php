<?php

$cfg = [
    'host' => '127.0.0.1',
    'port' => 3306,
    'db'   => 'moja_strona',
    'user' => 'WPISZ NAZWE UZYTKOWNIKA',
    'pass' => 'WPISZ HASLO',
];

$dsn = sprintf(
    'mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',
    $cfg['host'],
    $cfg['port'],
    $cfg['db']
);

$pdo = new PDO($dsn, $cfg['user'], $cfg['pass'], [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);
