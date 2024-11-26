<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Aluno</title>
    <style>
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
            width: 95%;
            max-width: 1200px;
            text-align: center;
            overflow: hidden;
        }

        fieldset {
            border: none;
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr; /* Duas colunas */
            gap: 20px;
            align-items: start;
            margin: 0;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px; /* Espaço entre label e input */
        }

        label {
            text-align: left; /* Alinha as labels à esquerda */
        }

        input[type="text"],
        input[type="password"],
        input[type="tel"],
        input[type="date"],
        input[type="submit"],
        input[type="radio"] {
            padding: 8px;
            border-radius: 5px;
            border: none;
            font-size: 1em;
            background-color: rgba(255, 255, 255, 0.8);
            color: #333;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: rgb(20, 147, 220);
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: 800;
            grid-column: 1 / -1; /* Faz o botão ocupar toda a largura */
        }

        input[type="submit"]:hover {
            background-color: rgb(17, 54, 71);
        }

        .radio-group {
            display: flex;
            gap: 15px; /* Espaço entre os botões de rádio */
            align-items: center;
        }

        .address-group {
            display: grid;
            grid-template-columns: 1fr 1fr; /* Campos iguais */
            gap: 10px;
            width: 100%;
            grid-column: 1 / -1; /* Linha ocupa toda a largura */
        }

        p {
            text-align: left;
            width: 100%;
            margin: 10px 0 5px;
            font-size: 1em;
        }

        a {
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

        a:hover {
            background-color: rgb(17, 54, 71);
        }

        @media (max-width: 768px) {
            form {
                grid-template-columns: 1fr; /* Ajusta para uma única coluna em telas menores */
            }

            .address-group {
                grid-template-columns: 1fr; /* Cada campo em uma linha separada */
            }
        }
    </style>
</head>
<body>
    <div class="box">
        <h1>Novo Aluno</h1>
        <fieldset>
            <form action="recebe_aluno_novo.php" method="POST">
                <div class="form-group">
                    <label for="nome">Nome completo</label>
                    <input type="text" name="nome" id="nome" required placeholder="Digite o nome completo">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" required placeholder="Digite o seu e-mail">
                </div>

                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="tel" name="telefone" id="telefone" required placeholder="Digite o número de telefone">
                </div>

                <div class="form-group">
                    <p>Sexo:</p>
                    <div class="radio-group">
                        <label><input type="radio" id="feminino" name="genero" value="feminino" required> Feminino</label>
                        <label><input type="radio" id="masculino" name="genero" value="masculino" required> Masculino</label>
                        <label><input type="radio" id="outro" name="genero" value="outro" required> Outro</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" id="data_nascimento" required>
                </div>

                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" id="cidade" required placeholder="Digite o nome da cidade">
                </div>

                <div class="address-group">
                    <div class="form-group">
                        <label for="endereco">Endereço</label>
                        <input type="text" name="endereco" id="endereco" required placeholder="Digite o endereço completo">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input type="text" name="estado" id="estado" required placeholder="Digite o estado">
                    </div>
                </div>

                <input type="submit" name="submit" id="submit" value="Cadastrar">
            </form>
        </fieldset>
        <a href="dashboard.php">VOLTAR</a>
    </div>
</body>
</html>


