<?php
declare(strict_types=1);

require_once __DIR__ . '/Funcionario.php';

class Gerente extends Funcionario
{
    public function calcularBonus(): float
    {
        return $this->salario * 0.15;
    }
}
