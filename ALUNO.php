<?php
session_start();
include_once("verifica.php");
include_once("conexao.php");  // Inclui o arquivo de conexão PDO

// Recupera o email do usuário logado, ou define como 'Visitante' se não estiver logado
$logado = isset($_SESSION['email']) ? $_SESSION['email'] : 'Visitante';

// Inicializa a consulta SQL
if (!empty($_GET['search'])) {
    // Evita vulnerabilidades como SQL Injection ao filtrar a entrada
    $data = htmlspecialchars($_GET['search']);
    $sql = "SELECT * FROM alunos WHERE id LIKE :search OR nome LIKE :search OR email LIKE :search ORDER BY id DESC";

    // Prepara a consulta usando PDO
    $stmt = $pdo->prepare($sql);
    $searchParam = "%$data%";
    $stmt->bindParam(':search', $searchParam, PDO::PARAM_STR);
    $stmt->execute();

    // Obtém os resultados
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $sql = "SELECT * FROM alunos ORDER BY id DESC";
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>ALUNOS</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: white;
            background: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            background-attachment: fixed;
            background-size: cover;
            text-align: center;
        }

        .table-bg {
            background: rgba(0, 0, 0, 0.6);
            border-radius: 15px;
            color: white;
        }

        .box-search {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 20px 0;
        }

        .btn-primary {
            background-color: rgb(20, 147, 220);
            border: none;
        }

        .btn-primary:hover {
            background-color: rgb(17, 54, 71);
        }

        .btn-voltar {
            color: #fff;
            background-color: rgb(20, 147, 220);
            border: none;
            padding: 0.5% 2%;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-voltar:hover {
            background-color: rgb(17, 54, 71);
        }

        h1.nome-aluno {
            font-weight: bold;
            font-size: 2rem;
            margin: 20px 0;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        th,
        td {
            vertical-align: middle;
            text-align: center;
        }

        /* Espaço entre os botões de ação (Editar e Deletar) */
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 5px; /* Espaçamento uniforme entre os botões */
            flex-wrap: nowrap; /* Impede quebra de linha */
        }

        .action-buttons a {
            color: white;
            text-decoration: none;
            margin: 0;
        }

        .btn-sm {
            padding: 0.4rem 0.6rem;
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <h1 class="nome-aluno">ALUNOS</h1>
    <div class="box-search">
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchData()" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
            </svg>
        </button>
        <a href="dashboard.php" class="btn-voltar">Voltar</a>
    </div>

    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
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
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($result as $user_data) {
                    echo "<tr>";
                    echo "<td>" . $user_data['id'] . "</td>";
                    echo "<td>" . $user_data['nome'] . "</td>";
                    echo "<td>" . $user_data['email'] . "</td>";
                    echo "<td>" . $user_data['telefone'] . "</td>";
                    echo "<td>" . $user_data['sexo'] . "</td>";
                    echo "<td>" . $user_data['data_nasc'] . "</td>";
                    echo "<td>" . $user_data['cidade'] . "</td>";
                    echo "<td>" . $user_data['estado'] . "</td>";
                    echo "<td>" . $user_data['endereco'] . "</td>";
                    echo "<td class='action-buttons'>
                            <a class='btn btn-sm btn-primary' href='edit.php?id=$user_data[id]'>Editar</a>
                            <a class='btn btn-sm btn-danger' href='delete.php?id=$user_data[id]'>Deletar</a>
                            <a class='btn btn-sm btn-warning' href='ver_aluno.php?id=$user_data[id]'>Ver aluno</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script>
        function searchData() {
            const searchTerm = document.getElementById('pesquisar').value;
            window.location.href = `ALUNO.php?search=${searchTerm}`;
        }
    </script>
</body>

</html>
