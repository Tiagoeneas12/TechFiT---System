<?php
session_start();
include_once("verifica.php");
include_once("conexao.php"); 

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Receber os dados do formulário
    $id_aluno = $_POST['idAluno'];  // Corrigido o nome do campo
    $nome_treino = $_POST['nomeTreino'];  // Corrigido o nome do campo

    // Verifica se os dados foram recebidos corretamente
    if (!empty($id_aluno) && !empty($nome_treino)) {
        try {
            // Inserir o treino na tabela 'treinos'
            $sql_treino = "INSERT INTO treinos (id_aluno, nome_treino) VALUES (:id_aluno, :nome_treino)";
            $stmt_treino = $pdo->prepare($sql_treino);
            $stmt_treino->bindParam(':id_aluno', $id_aluno, PDO::PARAM_INT);
            $stmt_treino->bindParam(':nome_treino', $nome_treino, PDO::PARAM_STR);
            $stmt_treino->execute();

            // Obter o ID do treino recém inserido
            $id_treino = $pdo->lastInsertId();

            // Verifica se os dados dos exercícios foram recebidos e insere
            if (isset($_POST['exercicio']) && isset($_POST['series'])) {
                $nome_exercicios = $_POST['exercicio'];
                $series = $_POST['series'];

                // Inserir os exercícios na tabela 'exercicios'
                foreach ($nome_exercicios as $index => $nome_exercicio) {
                    if (!empty($nome_exercicio) && !empty($series[$index])) {
                        $sql_exercicio = "INSERT INTO exercicios (id_treino, nome_exercicio, series) VALUES (:id_treino, :nome_exercicio, :series)";
                        $stmt_exercicio = $pdo->prepare($sql_exercicio);
                        $stmt_exercicio->bindParam(':id_treino', $id_treino, PDO::PARAM_INT);
                        $stmt_exercicio->bindParam(':nome_exercicio', $nome_exercicio, PDO::PARAM_STR);
                        $stmt_exercicio->bindParam(':series', $series[$index], PDO::PARAM_STR);
                        $stmt_exercicio->execute();
                    }
                }
            }

            // Mensagem de sucesso
            echo "Treino e exercícios inseridos com sucesso!";
            // Redirecionar para a página ou resetar o form após sucesso
            header("Refresh:2; url=".$_SERVER['PHP_SELF']); // Redireciona e faz o refresh após 2 segundos
        } catch (PDOException $e) {
            echo "Erro ao inserir dados: " . $e->getMessage();
        }
    } else {
        echo "Por favor, preencha todos os campos obrigatórios.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Treinos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            color: #fff;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            width: 90%;
            max-width: 800px;
        }

        h1, h2 {
            text-align: center;
        }

        fieldset {
            border: none;
            margin: 10px 0;
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
            display: block;
        }

        input, select {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: none;
            background-color: rgba(255, 255, 255, 0.8);
            color: #333;
        }

        button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: rgb(20, 147, 220);
            color: #fff;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: rgb(17, 54, 71);
        }

        .btn-voltar a {
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            background-color: rgb(20, 147, 220);
            cursor: pointer;
            transition: background-color 0.3s;
            padding: 0.5% 2%;
            font-weight: 800;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .btn-voltar a:hover {
            background-color: rgb(17, 54, 71);
        }

        .exercicio-item {
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .exercicio-item input {
            flex: 1;
        }

        .exercicio-item button {
            padding: 5px 10px;
            background-color: rgb(255, 69, 58);
        }

        .exercicio-item button:hover {
            background-color: rgb(200, 35, 35);
        }

    </style>
</head>

<body>
    <div class="container">
        <h1>Formulário de Treino</h1>
        <div class="btn-voltar">
            <a href="dashboard.php">VOLTAR</a>
        </div>
        <form id="formTreino" method="POST" action="">
            <fieldset>
                <legend>Dados do Treino</legend>
                <label for="idAluno">ID do Aluno:</label>
                <input type="number" id="idAluno" name="idAluno" placeholder="Digite o ID do aluno" required>

                <label for="nomeTreino">Nome do Treino:</label>
                <input type="text" id="nomeTreino" name="nomeTreino" placeholder="Ex: Treino A" required>
            </fieldset>

            <fieldset>
                <legend>Exercícios</legend>
                <div id="exerciciosContainer"></div>
                <button type="button" id="addExercicio">Adicionar Exercício</button>
            </fieldset>

            <button type="submit">Salvar Treino</button>
        </form>
    </div>

    <script>
        const exerciciosContainer = document.getElementById('exerciciosContainer');
        const addExercicioButton = document.getElementById('addExercicio');

        addExercicioButton.addEventListener('click', () => {
            const exercicioItem = document.createElement('div');
            exercicioItem.classList.add('exercicio-item');

            exercicioItem.innerHTML = `
                <input type="text" name="exercicio[]" placeholder="Nome do exercício" required>
                <input type="text" name="series[]" placeholder="Séries (Ex: 3x12)" required>
                <button type="button" class="removeExercicio">Excluir</button>
            `;

            exercicioItem.querySelector('.removeExercicio').addEventListener('click', () => {
                exercicioItem.remove();
            });

            exerciciosContainer.appendChild(exercicioItem);
        });
    </script>
</body>

</html>





