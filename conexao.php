<?php

$host = 'localhost'; // Endereço do servidor
$dbname = 'clientes'; // Nome do banco de dados
$user = 'root'; // Usuário do banco de dados
$password = ''; // Senha do banco de dados

try {
    // Cria a conexão PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    
    // Configura o modo de erro do PDO para lançar exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Exibe mensagem de erro caso a conexão falhe
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    exit; // Encerra o script em caso de erro
}
?>
