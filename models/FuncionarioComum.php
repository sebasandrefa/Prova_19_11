<?php
declare(strict_types=1);

require_once __DIR__ . '/Funcionario.php';

class FuncionarioComum extends Funcionario
{
    public function calcularBonus(): float
    {
        return $this->salario * 0.05;
    }
}
