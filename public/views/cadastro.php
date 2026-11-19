<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestão de funcionários</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main class="container">
    <header class="topo">
        <div>
            <p class="eyebrow">EMPRESA</p>
            <h1>Gestão de funcionários</h1>
        </div>

        <?php if (isset($_SESSION['operador'])): ?>
            <div class="sessao">
                <span>Olá, <strong><?= htmlspecialchars($_SESSION['operador'], ENT_QUOTES, 'UTF-8') ?></strong></span>
                <form method="post">
                    <input type="hidden" name="acao" value="encerrar_sessao">
                    <button class="button secondary" type="submit">Encerrar sessão</button>
                </form>
            </div>
        <?php else: ?>
            <form class="sessao" method="post">
                <input type="hidden" name="acao" value="iniciar_sessao">
                <label for="operador">Nome do operador</label>
                <input id="operador" name="operador" required maxlength="100" placeholder="Seu nome">
                <button class="button secondary" type="submit">Iniciar sessão</button>
            </form>
        <?php endif; ?>
    </header>

    <?php if ($mensagem !== ''): ?>
        <div class="alert success" role="status">
            <?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>

    <?php if ($erro !== ''): ?>
        <div class="alert error" role="alert">
            <?= htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>

    <?php if ($funcionarioExcluir): ?>
        <section class="card confirmacao">
            <h2>Confirmar exclusão</h2>
            <p>Deseja excluir <strong><?= htmlspecialchars($funcionarioExcluir['nome'], ENT_QUOTES, 'UTF-8') ?></strong>?</p>
            <form method="post" class="acoes">
                <input type="hidden" name="acao" value="excluir">
                <input type="hidden" name="id" value="<?= (int)$funcionarioExcluir['id'] ?>">
                <button class="button danger" type="submit">Confirmar exclusão</button>
                <a class="button secondary" href="index.php">Cancelar</a>
            </form>
        </section>
    <?php endif; ?>

    <section class="card">
        <div class="section-heading">
            <div>
                <p class="eyebrow">NOVO REGISTRO</p>
                <h2>Cadastrar funcionário</h2>
            </div>
        </div>

        <form method="post" action="index.php" class="form-grid">
            <input type="hidden" name="acao" value="cadastrar">
            <label for="nome">Nome
                <input id="nome" name="nome" type="text" required maxlength="100" autocomplete="name">
            </label>

            <label for="email">E-mail
                <input id="email" name="email" type="email" required maxlength="150" autocomplete="email">
            </label>

            <label for="salario">Salário (R$)
                <input id="salario" name="salario" type="number" min="0" step="0.01" required>
            </label>

            <label for="tipo">Tipo de funcionário
                <select id="tipo" name="tipo" required>
                    <option value="">Selecione</option>
                    <option value="comum">Funcionário comum</option>
                    <option value="gerente">Gerente</option>
                </select>
            </label>

            <div class="form-actions">
                <button class="button" type="submit">Cadastrar funcionário</button>
            </div>
        </form>
    </section>
