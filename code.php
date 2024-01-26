<?php
session_start();
require 'dbcon.php';

if(isset($_POST['delete_carro']))
{
    $carro_id = mysqli_real_escape_string($con, $_POST['delete_carro']);

    $sqlDeleteCarros = "DELETE FROM carros WHERE id_vendedor = $id";
    $query = "DELETE FROM carros WHERE id='$carro_id' ";

    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Carro Deletado!";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Carro Nao Deletado!!!";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['delete_vendedor']))
{
    $vendedor_id = mysqli_real_escape_string($con, $_POST['delete_vendedor']);

    $check_cars_query = "SELECT COUNT(*) FROM carros WHERE id_vendedor = $vendedor_id";
    $result = mysqli_query($con, $check_cars_query);
    $row = mysqli_fetch_array($result);

    if ($row[0] > 0) {
        // Vendedor tem carros associados
        $_SESSION['message'] = "Não é possível excluir o vendedor. Remova ou edite os carros associados a este vendedor primeiro.";
        $_SESSION['msg_type'] = "danger";
        header("location: index.php"); 
        exit();
    }

    $query = "DELETE FROM vendedores WHERE id='$vendedor_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Vendedor Deletado!";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Vendedor Nao Deletado!!!";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['update_carro']))
{
    $carro_id = mysqli_real_escape_string($con, $_POST['carros_id']);

    $modelo = mysqli_real_escape_string($con, $_POST['modelo']);
    $cor = mysqli_real_escape_string($con, $_POST['cor']);
    $ano = mysqli_real_escape_string($con, $_POST['ano']);
    $placa = mysqli_real_escape_string($con, $_POST['placa']);
    $id_vendedor = mysqli_real_escape_string($con, $_POST['vendedor']);

    if (!validarPlaca($placa)) {
        $_SESSION['message'] = "Erro: Placa inválida!";
        $_SESSION['msg_type'] = "danger";
        header("location: index.php");
        exit();
    }

    $query = "UPDATE carros SET modelo='$modelo', cor='$cor', ano='$ano', placa='$placa', id_vendedor='$id_vendedor' WHERE id='$carro_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Carro atualizado!";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Carro nao atualizado!!!";
        header("Location: index.php");
        exit(0);
    }

}

if(isset($_POST['update_vendedor']))
{
    $vendedor_id = mysqli_real_escape_string($con, $_POST['vendedores_id']);

    $nome = mysqli_real_escape_string($con, $_POST['nome']);
    $cpf = mysqli_real_escape_string($con, $_POST['cpf']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $telefone = mysqli_real_escape_string($con, $_POST['telefone']);

    if (!validarCPF($cpf)) {
        $_SESSION['message'] = "Erro: CPF inválido!";
        $_SESSION['msg_type'] = "danger";
        header("location: index.php");
        exit();
    }

    if (!validarTelefone($telefone)) {
        $_SESSION['message'] = "Erro: Número de telefone inválido!";
        $_SESSION['msg_type'] = "danger";
        header("location: index.php");
        exit();
    }


    $query = "UPDATE vendedores SET nome='$nome', cpf='$cpf', email='$email', telefone='$telefone' WHERE id='$vendedor_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Vendedor atualizado!";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Vendedor nao atualizado!!!";
        header("Location: index.php");
        exit(0);
    }

}


if(isset($_POST['save_carro']))
{
    $modelo = mysqli_real_escape_string($con, $_POST['modelo']);
    $cor = mysqli_real_escape_string($con, $_POST['cor']);
    $ano = mysqli_real_escape_string($con, $_POST['ano']);
    $placa = mysqli_real_escape_string($con, $_POST['placa']);
    $id_vendedor = mysqli_real_escape_string($con, $_POST['vendedor']);

    if (!validarPlaca($placa)) {
        $_SESSION['message'] = "Erro: Placa inválida!";
        $_SESSION['msg_type'] = "danger";
        header("location: consecionariaCreate.php");
        exit();
    }

    $query = "INSERT INTO carros (modelo,cor,ano,placa,id_vendedor) VALUES ('$modelo','$cor','$ano','$placa','$id_vendedor')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Carro Adicionado!";
        header("Location: consecionariaCreate.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Carro Nao Adicionado!!!";
        header("Location: consecionariaCreate.php");
        exit(0);
    }
}

function validarPlaca($placa)
{
    // Padrão de placa no Brasil: AAA0A00 ou AAA0A0A
    $padraoPlaca = "/^[A-Z]{3}[0-9]{1}[A-Z]{1}[0-9]{2}$/";

    // Verificar se a placa corresponde ao padrão
    return preg_match($padraoPlaca, $placa);
}



if(isset($_POST['save_vendedor']))
{
    $nome = mysqli_real_escape_string($con, $_POST['nome']);
    $cpf = mysqli_real_escape_string($con, $_POST['cpf']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $telefone = mysqli_real_escape_string($con, $_POST['telefone']);

    if (!validarCPF($cpf)) {
        $_SESSION['message'] = "Erro: CPF inválido!";
        $_SESSION['msg_type'] = "danger";
        header("location: cadastroVende.php");
        exit();
    }

    if (!validarTelefone($telefone)) {
        $_SESSION['message'] = "Erro: Número de telefone inválido!";
        $_SESSION['msg_type'] = "danger";
        header("location: cadastrar_vendedor.php");
        exit();
    }

    $query = "INSERT INTO vendedores (nome,cpf,email,telefone) VALUES ('$nome','$cpf','$email','$telefone')";

    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Vendedor Adicionado!";
        header("Location: cadastroVende.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Vendedor Nao Adicionado!!!";
        header("Location: cadastroVende.php");
        exit(0);
    }
}

function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    if (strlen($cpf) != 11 || preg_match('/^(\d)\1*$/', $cpf)) {
        return false;
    }

    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += $cpf[$i] * (10 - $i);
    }

    $resto = $soma % 11;
    $digito1 = ($resto < 2) ? 0 : 11 - $resto;

    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
        $soma += $cpf[$i] * (11 - $i);
    }

    $resto = $soma % 11;
    $digito2 = ($resto < 2) ? 0 : 11 - $resto;

    return ($cpf[9] == $digito1 && $cpf[10] == $digito2);
}

function validarTelefone($telefone) {
    // Remover caracteres não numéricos
    $telefone = preg_replace('/[^0-9]/', '', $telefone);

    // Verificar se o telefone tem 11 dígitos
    if (strlen($telefone) != 11) {
        return false;
    }

    return true;
}

?>