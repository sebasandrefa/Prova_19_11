<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../models/FuncionarioComum.php';
require_once __DIR__ . '/../models/Gerente.php';

$mensagem = '';
$erro = '';
$funcionarios = [];
$funcionarioExcluir = null;
$metodo = $_SERVER['REQUEST_METHOD'] ?? 'GET';

try {
    if ($metodo === 'POST') {
        $acao = $_POST['acao'] ?? '';

        if ($acao === 'iniciar_sessao') {
            $operador = trim((string) ($_POST['operador'] ?? ''));
            if ($operador === '') {
                throw new InvalidArgumentException('Informe seu nome para iniciar.');
            }

            $_SESSION['operador'] = $operador;
            header('Location: index.php');
            exit;
        }

        if ($acao === 'encerrar_sessao') {
            unset($_SESSION['operador']);
            header('Location: index.php');
            exit;
        }
    }

    $pdo = conectarBanco();

    if ($metodo === 'POST') {
        $acao = $_POST['acao'] ?? '';

        if ($acao === 'cadastrar') {
            $nome = trim((string) ($_POST['nome'] ?? ''));
            $email = trim((string) ($_POST['email'] ?? ''));
            $salarioTexto = trim((string) ($_POST['salario'] ?? ''));
            $tipo = (string) ($_POST['tipo'] ?? '');

            if ($nome === '' || $email === '' || $salarioTexto === '' || $tipo === '') {
                throw new InvalidArgumentException('Preencha todos os campos obrigatórios.');
            }

            if (!is_numeric($salarioTexto)) {
                throw new InvalidArgumentException('Informe um salário válido.');
            }

            if (!in_array($tipo, ['comum', 'gerente'], true)) {
                throw new InvalidArgumentException('Tipo de funcionário inválido.');
            }

            if ($tipo === 'gerente') {
                $funcionario = new Gerente($nome, $email, (float) $salarioTexto);
            } else {
                $funcionario = new FuncionarioComum($nome, $email, (float) $salarioTexto);
            }
            $comando = $pdo->prepare(
                'INSERT INTO funcionarios (nome, email, salario, tipo) '
                . 'VALUES (:nome, :email, :salario, :tipo)'
            );
            $comando->execute([
                'nome' => $funcionario->getNome(),
                'email' => $funcionario->getEmail(),
                'salario' => $funcionario->getSalario(),
                'tipo' => $tipo,
            ]);

            header('Location: index.php?sucesso=cadastro');
            exit;
        }

        if ($acao === 'excluir') {
            $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
            if ($id === false || $id === null || $id < 1) {
                throw new InvalidArgumentException('Funcionário inválido para exclusão.');
            }

            $comando = $pdo->prepare('DELETE FROM funcionarios WHERE id = :id');
            $comando->execute(['id' => $id]);

            header('Location: index.php?sucesso=exclusao');
            exit;
        }
    }

    if (isset($_GET['sucesso'])) {
        $mensagem = $_GET['sucesso'] === 'exclusao'
            ? 'Funcionário excluído com sucesso.'
            : 'Funcionário cadastrado com sucesso.';
    }

    $excluirId = isset($_GET['excluir'])
        ? filter_var($_GET['excluir'], FILTER_VALIDATE_INT)
        : false;

    if ($excluirId !== false && $excluirId > 0) {
        $comando = $pdo->prepare('SELECT id, nome FROM funcionarios WHERE id = :id');
        $comando->execute(['id' => $excluirId]);
        $funcionarioExcluir = $comando->fetch() ?: null;
    }

    $funcionarios = $pdo
        ->query('SELECT id, nome, email, salario, tipo FROM funcionarios ORDER BY nome')
        ->fetchAll();
} catch (InvalidArgumentException $exception) {
    $erro = $exception->getMessage();
} catch (Throwable $exception) {
    $erro = 'Não foi possível acessar o banco de dados. Confira a conexão e importe banco.sql.';
}

require __DIR__ . '/../views/cadastro.php';
require __DIR__ . '/../views/lista.php';
