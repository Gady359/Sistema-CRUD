<?php
session_start();

require 'dbcon.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    $stmt = $con->prepare("SELECT id, senha FROM usuarios WHERE nome = ?");
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();

    if (password_verify($senha, $hashed_password)) {
        $_SESSION['user_id'] = $user_id;
        header("location: index.php");
    } else {
        $_SESSION['message'] = "Nome de usuário ou senha incorretos!";
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
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <div class="container">
        <form action="login.php" method="post" class="border p-3">
            <h2 class="mb-3">Login</h2>
            <?php include('message.php'); ?>
            <div class="form-group">
                <label for="username">Usuário:</label>
                <input type="text" name="nome" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" name="senha" class="form-control" id="password" required>
                <div class="input-group-append">
                        <div class="input-group-text">
                            <input type="checkbox" onclick="showPassword()"> Mostrar Senha
                        </div>
                    </div>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p class="mt-3">Não tem uma conta? <a href="registro.php">Registre-se aqui</a></p>
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