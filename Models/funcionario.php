<?php
declare(strict_types=1);

abstract class Funcionario
{
    protected string $nome;
    protected string $email;
    protected float $salario;

    public function __construct(string $nome, string $email, float $salario)
    {
        $this->setNome($nome);
        $this->setEmail($email);
        $this->setSalario($salario);
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $nome = trim($nome);
        if ($nome === '') {
            throw new InvalidArgumentException('O nome é obrigatório.');
        }

        $this->nome = $nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $email = trim($email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Informe um e-mail válido.');
        }

        $this->email = $email;
    }

    public function getSalario(): float
    {
        return $this->salario;
    }

    public function setSalario(float $salario): void
    {
        if (!is_finite($salario) || $salario < 0) {
            throw new InvalidArgumentException('O salário deve ser um valor maior ou igual a zero.');
        }

        $this->salario = $salario;
    }

    abstract public function calcularBonus(): float;
}
