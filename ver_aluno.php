<?php
session_start();
include_once("verifica.php");
include_once("conexao.php");  // Inclui o arquivo de conexão PDO

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Consulta principal para o cadastro do aluno
    $stmtAluno = $pdo->prepare("SELECT * FROM alunos WHERE id = :id");
    $stmtAluno->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtAluno->execute();
    $aluno = $stmtAluno->fetch(PDO::FETCH_ASSOC);

    // Consulta para os treinos do aluno, puxando o nome do treino, o nome do exercício e as séries
    $stmtTreinos = $pdo->prepare("
        SELECT t.nome_treino, e.nome_exercicio, e.series
        FROM treinos t
        JOIN exercicios e ON e.id_treino = t.id
        WHERE t.id_aluno = :id
    ");
    $stmtTreinos->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtTreinos->execute();
    $treinos = $stmtTreinos->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para os dados financeiros do aluno
    $stmtFinanceiro = $pdo->prepare("SELECT * FROM financeiro WHERE aluno_id = :id");
    $stmtFinanceiro->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtFinanceiro->execute();
    $financeiro = $stmtFinanceiro->fetchAll(PDO::FETCH_ASSOC);
} else {
    header("Location: ALUNO.php");
    exit();
}
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detalhes do Aluno</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            color: white;
        }

        /* Estilo comum para ambos os botões */
        .btn-comum {
            color: #fff;
            background-color: rgb(20, 147, 220);
            border: none;
            padding: 0.5% 2%;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
            display: block;
            margin-bottom: 10px;
            /* Adicionando espaçamento entre os botões */
        }

        .btn-comum:hover {
            background-color: rgb(17, 54, 71);
        }

        .table-bg {
            background: rgba(0, 0, 0, 0.6);
            border-radius: 15px;
            margin-top: 20px;
        }

        .table th,
        .table td {
            color: white;
        }

        /* Box container */
        .box {
            padding: 20px;
            border: 2px solid rgb(20, 147, 220);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            background-color: rgba(0, 0, 0, 0.7);
        }

        /* Alinhando os botões */
        .container-buttons {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            /* Alinha os botões à direita */
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h1>Detalhes do Aluno</h1>

        <!-- Box container com o conteúdo -->
        <div class="box">
            <div class="container-buttons">
                <!-- Botões alinhados um abaixo do outro -->
                <a href="ALUNO.php" class="btn-comum">Voltar</a>
            </div>

            <div class="table-responsive">
                <h2>Cadastro</h2>
                <table class="table table-bg">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Sexo</th>
                        <th>Data de Nascimento</th>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>Endereço</th>
                    </tr>
                    <tr>
                        <td><?php echo $aluno['id']; ?></td>
                        <td><?php echo $aluno['nome']; ?></td>
                        <td><?php echo $aluno['email']; ?></td>
                        <td><?php echo $aluno['telefone']; ?></td>
                        <td><?php echo $aluno['sexo']; ?></td>
                        <td><?php echo $aluno['data_nasc']; ?></td>
                        <td><?php echo $aluno['cidade']; ?></td>
                        <td><?php echo $aluno['estado']; ?></td>
                        <td><?php echo $aluno['endereco']; ?></td>
                    </tr>
                </table>

                <h2>Treinos</h2>
                <table class="table table-bg">
                    <tr>
                        <th>Treino</th>
                        <th>Exercício</th>
                        <th>Séries</th>
                    </tr>
                    <?php foreach ($treinos as $treino) : ?>
                        <tr>
                            <td><?php echo $treino['nome_treino']; ?></td>
                            <td><?php echo $treino['nome_exercicio']; ?></td>
                            <td><?php echo $treino['series']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <h2>Financeiro</h2>
                <table class="table table-bg">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Valor</th>
                            <th>Forma de Pagamento</th>
                            <th>Plano</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($financeiro)) : ?>
                            <?php foreach ($financeiro as $fin) : ?>
                                <tr>
                                    <td><?php echo isset($fin['id']) ? $fin['id'] : 'N/A'; ?></td>
                                    <td><?php echo isset($fin['valor']) ? $fin['valor'] : 'N/A'; ?></td>
                                    <td><?php echo isset($fin['pagamento']) ? $fin['pagamento'] : 'N/A'; ?></td>
                                    <td><?php echo isset($fin['plano']) ? $fin['plano'] : 'N/A'; ?></td>
                                    <td><?php echo isset($fin['data']) ? $fin['data'] : 'N/A'; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="text-center">Nenhuma informação financeira encontrada.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</body>

</html>