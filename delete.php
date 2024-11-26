<?php
session_start();
include_once("verifica.php");

if (!empty($_GET['id'])) {
    include_once("conexao.php");

    $id = $_GET['id'];

    // Inicia a transação para garantir que todas as exclusões aconteçam de forma atômica
    $pdo->beginTransaction();

    try {
        // Exclui os registros financeiros relacionados ao aluno
        $sqlDeleteFinanceiro = "DELETE FROM financeiro WHERE aluno_id = :id";
        $stmtDeleteFinanceiro = $pdo->prepare($sqlDeleteFinanceiro);
        $stmtDeleteFinanceiro->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtDeleteFinanceiro->execute();

        // Exclui os treinos do aluno
        $sqlDeleteTreinos = "DELETE FROM treinos WHERE id_aluno = :id";
        $stmtDeleteTreinos = $pdo->prepare($sqlDeleteTreinos);
        $stmtDeleteTreinos->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtDeleteTreinos->execute();

        // Exclui os registros do aluno
        $sqlDeleteAluno = "DELETE FROM alunos WHERE id = :id";
        $stmtDeleteAluno = $pdo->prepare($sqlDeleteAluno);
        $stmtDeleteAluno->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtDeleteAluno->execute();

        // Se todas as operações ocorreram com sucesso, comita a transação
        $pdo->commit();
    } catch (Exception $e) {
        // Se ocorrer algum erro, desfaz a transação
        $pdo->rollBack();
        // Exibe a mensagem de erro
        echo "Erro ao deletar os dados: " . $e->getMessage();
        exit;
    }
}

// Redireciona de volta para a página de alunos
header('Location: aluno.php');
exit;
?>

