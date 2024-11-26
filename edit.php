<?php
session_start();
include_once("verifica.php");
include_once("conexao.php");

if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $sqlSelect = "SELECT * FROM alunos WHERE id = :id";
    $stmt = $pdo->prepare($sqlSelect);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $nome = $user_data['nome'];
        $email = $user_data['email'];
        $telefone = $user_data['telefone'];
        $sexo = $user_data['sexo'];
        $data_nasc = $user_data['data_nasc'];
        $cidade = $user_data['cidade'];
        $estado = $user_data['estado'];
        $endereco = $user_data['endereco'];
    } else {
        header('Location: aluno.php');
        exit;
    }
} else {
    header('Location: aluno.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente | Alunos</title>
    <style>
        /* Estilização permanece a mesma */
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: #fff;
        }

        .box {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.5);
            text-align: left;
            width: 400px;
        }

        fieldset {
            border: none;
            width: 100%;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        input[type="text"],
        input[type="tel"],
        input[type="date"],
        input[type="submit"] {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: none;
            width: 100%; /* Campos alinhados */
            max-width: 350px; /* Limite de largura */
            font-size: 1em;
            background-color: rgba(255, 255, 255, 0.8);
            color: #333;
        }

        input[type="submit"] {
            background-color: rgb(20, 147, 220);
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: rgb(17, 54, 71);
        }

        h1 {
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            margin-bottom: 10px;
            font-size: 0.9rem;
        }

        .radio-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .radio-group label {
            margin: 3px 0;
        }

        .radio-group input[type="radio"] {
            margin-right: 5px;
        }

        .voltar {
            position: absolute;
            top: 10px;
            right: 10px;
            color: white;
            text-decoration: none;
            text-decoration-line: none;
            font-size: 1rem;
            background-color: rgb(20, 147, 220);
            border-radius: 5px;
            border:none;
            padding:0.5% 2%;
            color:#FFF;
            font-weight: bold;
            
        }

        legend {
            text-align: center;
        }
    </style>
</head>
<body>
    <a href="aluno.php" class="voltar">Voltar</a>
    <div class="box">
        <form action="saveEdit.php" method="POST">
            <fieldset>
                <legend><b>Editar Dados do Cliente</b></legend>
                <br>
                <label for="nome">Nome completo</label>
                <input type="text" name="nome" id="nome" value="<?php echo $nome; ?>" required>

                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="<?php echo $email; ?>" required>

                <label for="telefone">Telefone</label>
                <input type="tel" name="telefone" id="telefone" value="<?php echo $telefone; ?>" required>

                <p>Sexo:</p>
                <div class="radio-group">
                    <label><input type="radio" id="feminino" name="genero" value="feminino" <?php echo ($sexo == 'feminino') ? 'checked' : ''; ?> required> Feminino</label>
                    <label><input type="radio" id="masculino" name="genero" value="masculino" <?php echo ($sexo == 'masculino') ? 'checked' : ''; ?> required> Masculino</label>
                    <label><input type="radio" id="outro" name="genero" value="outro" <?php echo ($sexo == 'outro') ? 'checked' : ''; ?> required> Outro</label>
                </div>

                <label for="data_nascimento">Data de Nascimento</label>
                <input type="date" name="data_nascimento" id="data_nascimento" value="<?php echo $data_nasc; ?>" required>

                <label for="cidade">Cidade</label>
                <input type="text" name="cidade" id="cidade" value="<?php echo $cidade; ?>" required>

                <label for="estado">Estado</label>
                <input type="text" name="estado" id="estado" value="<?php echo $estado; ?>" required>

                <label for="endereco">Endereço</label>
                <input type="text" name="endereco" id="endereco" value="<?php echo $endereco; ?>" required>

                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="update" value="Salvar">
            </fieldset>
        </form>
    </div>
</body>
</html>

