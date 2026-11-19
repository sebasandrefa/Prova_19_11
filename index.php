<?php
declare(strict_types=1);

// Mantém os dados do operador enquanto ele navega pelo sistema.
session_start();

// O controller processa os formulários e chama as páginas.
require_once __DIR__ . '/controllers/funcionarios.php';
