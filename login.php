<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechFit System</title>
    <link rel="stylesheet" href="login.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <form method="POST" action="recebe_login.php">
        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario" required><br><br>
        <label for="pass">Senha:</label>
        <input type="password" id="pass" name="pass" required><br><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
