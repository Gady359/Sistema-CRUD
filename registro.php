<?php
session_start();

require 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $stmt = $con->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email ,$senha);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Registro realizado com sucesso!";
        $_SESSION['msg_type'] = "success";
        header("location: login.php");
        exit();
    } else {
        $_SESSION['message'] = "Erro ao registrar: " . $stmt->error;
        $_SESSION['msg_type'] = "danger";
    }

    $stmt->close();
    $con->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <div class="container">
        <form action="registro.php" method="post" class="border p-3">
            <h2 class="mb-3">Cadastro</h2>
            <?php include('message.php'); ?>
            <div class="form-group">
                <label for="username">Usuário:</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" name="senha" class="form-control" id="password" required>
                <div class="input-group-append">
                        <div class="input-group-text">
                            <input type="checkbox" onclick="showPassword()">    Mostrar Senha
                        </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
        <p class="mt-3">Já tem uma conta? <a href="login.php">Faça login aqui</a></p>
    </div>
    <script>
        function showPassword() {
            var passwordInput = document.getElementById("password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>
</body>
</html>