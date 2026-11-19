<?php
declare(strict_types=1);

function conectarBanco(): PDO
{
    $host = 'localhost';
    $dbname = 'empresa_db';
    $usuario = 'root';
    $senha = '';

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
