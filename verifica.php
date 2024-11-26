<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Inicia a sessão apenas se ainda não estiver ativa
}

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    // Caso o usuário não esteja logado, redireciona para a página de login
    echo "<h1>Acesso indevido! Você precisa estar logado para acessar essa página.</h1>";
    header('Refresh: 3; URL=login.php');
    exit(); // Encerra o script para garantir que a execução não continue
}
?>





