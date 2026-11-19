    <section class="card">
        <div class="section-heading">
            <div>
                <p class="eyebrow">EQUIPE</p>
                <h2>Funcionários cadastrados</h2>
            </div>
            <span class="count"><?= count($funcionarios) ?> registro(s)</span>
        </div>

        <?php if (!$funcionarios): ?>
            <p class="empty">Nenhum funcionário cadastrado ainda.</p>
        <?php else: ?>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Funcionário</th>
                            <th>Tipo</th>
                            <th>Salário</th>
                            <th>Bônus</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($funcionarios as $registro): ?>
                            <?php
                            if ($registro['tipo'] === 'gerente') {
                                $funcionario = new Gerente(
                                    $registro['nome'],
                                    $registro['email'],
                                    (float) $registro['salario']
                                );
                                $tipoLegivel = 'Gerente';
                            } else {
                                $funcionario = new FuncionarioComum(
                                    $registro['nome'],
                                    $registro['email'],
                                    (float) $registro['salario']
                                );
                                $tipoLegivel = 'Funcionário comum';
                            }
                            ?>
                            <tr>
                                <td>
                                    <strong><?= htmlspecialchars($funcionario->getNome(), ENT_QUOTES, 'UTF-8') ?></strong>
                                    <small><?= htmlspecialchars($funcionario->getEmail(), ENT_QUOTES, 'UTF-8') ?></small>
                                </td>
                                <td><span class="badge"><?= $tipoLegivel ?></span></td>
                                <td>R$ <?= number_format($funcionario->getSalario(), 2, ',', '.') ?></td>
                                <td class="bonus">R$ <?= number_format($funcionario->calcularBonus(), 2, ',', '.') ?></td>
                                <td class="right">
                                    <a class="button danger-outline" href="index.php?excluir=<?= (int) $registro['id'] ?>">Excluir</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>
</main>
</body>
</html>
