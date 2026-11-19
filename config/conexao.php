<?php
declare(strict_types=1);

function conectarBanco(): PDO
{
    $host = 'sebastian755.devlook.xyz';
    $dbname = 'empresa_db';
    $usuario = 'sebastian755';
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
