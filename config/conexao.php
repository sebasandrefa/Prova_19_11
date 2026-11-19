<?php
declare(strict_types=1);

function conectarBanco(): PDO
{
    $host = 'sebastian315';
    $dbname = 'empresa_db';
    $usuario = 'sebastian315';
    $senha = '315!@#';

    return new PDO(
        "mysql:host={$host};dbname={$dbname};charset=utf8mb4",
        $usuario,
        $senha,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
}
