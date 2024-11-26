<?php
session_start(); // Inicia a sessão
include_once "verifica.php"; // Verifica se o usuário está logado
include_once "conexao.php"; // Conecta com o banco de dados

// Verifica se o formulário foi enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $genero = $_POST['genero'];
    $data_nascimento = $_POST['data_nascimento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $endereco = $_POST['endereco'];

    // Insere os dados no banco usando PDO
    try {
        $sql = "INSERT INTO alunos (nome, email, telefone, sexo, data_nasc, cidade, estado, endereco) 
                VALUES (:nome, :email, :telefone, :genero, :data_nascimento, :cidade, :estado, :endereco)";
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':telefone' => $telefone,
            ':genero' => $genero,
            ':data_nascimento' => $data_nascimento,
            ':cidade' => $cidade,
            ':estado' => $estado,
            ':endereco' => $endereco,
        ]);

        // Mensagem de sucesso com JavaScript
        echo "<script>
                alert('Aluno inserido com sucesso!');
                window.location.href = 'form_novo_aluno.php'; // Redireciona para a página aluno.php
              </script>";

    } catch (PDOException $e) {
        // Mensagem de erro com JavaScript
        echo "<script>
                alert('Erro ao inserir aluno: " . $e->getMessage() . "');
                window.location.href = 'aluno.php'; // Redireciona para a página aluno.php
              </script>";
    }
} else {
    // Se o acesso não for via POST, redireciona para o formulário
    header('Location: form_novo_aluno.php');
    exit;
}
?>


