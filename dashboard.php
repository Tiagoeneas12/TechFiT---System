<?php
session_start();
include_once("verifica.php");
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechFit System</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: #fff;
            position: relative;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
            background-attachment: fixed;
            background-size: cover;
        }

        /* Camada de sobreposição */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .navbar {
            position: relative;
            z-index: 2;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 15px 0;
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: auto;
        }

        .user-info {
            display: flex;
            align-items: center; /* Alinha ícone e nome verticalmente */
            gap: 8px;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
        }

        .user-icon {
            font-size: 18px; /* Ajusta o tamanho do ícone para melhor alinhamento */
        }

        .navbar-links {
            display: flex;
            gap: 30px;
        }

        .navbar-links a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            padding: 10px 20px;
            transition: background-color 0.3s;
        }

        .navbar-links a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
        }

        .logout {
            margin-left: 20px;
        }

        .logout-button {
            color: #ff6b6b;
            text-decoration: none;
            font-weight: bold;
            padding: 8px 15px;
            border: 2px solid #ff6b6b;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .logout-button:hover {
            background-color: #ff6b6b;
            color: #fff;
        }

        .escuro {
            height: calc(100vh - 60px);
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .content {
            position: relative;
            z-index: 2;
            height: calc(100vh - 60px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #fff;
        }

        .content h1 {
            font-size: 3rem;
            margin-bottom: 15px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        .content p {
            font-size: 1.5rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid navbar-content">
            <div class="user-info">
                <span class="user-icon">👤</span>
                <span class="username"><?php echo $_SESSION['usuario']; ?></span>
            </div>
            <div class="navbar-links">
                <a href="aluno.php">ALUNOS</a>
                <a href="form_novo_aluno.php">NOVO ALUNO</a>
                <a href="TREINOS.php">TREINOS</a>
                <a href="FINANCEIRO.php">FINANCEIRO</a>
                <a href="logout.php" class="logout-button">Sair</a>
            </div>
        </div>
    </nav>

    <div class="content">
        <h1>Bem-vindo ao TechFit System</h1>
        <p>Gerencie seus alunos e treinos de forma fácil e eficiente.</p>
    </div>
</body>

</html>
