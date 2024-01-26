<?php
    session_start();
    require 'dbcon.php';

    if (!isset($_SESSION['user_id'])) {
        header("location: login.php");
        exit();
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AS2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  <div class="container mt-5">

<?php include('message.php'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header ">
                <h4>Detalhes 
                    <a href="consecionariaCreate.php" class="btn btn-primary float-end m-1">Adicionar Carros</a>
                    
                    <a href="cadastroVende.php" class="btn btn-primary float-end m-1">Cadastrar Vendedor</a>
                </h4>
            </div>
            <div class="card-body">

                <table class="table table-bordered table-striped"><h2>Carros</h2>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Modelo</th>
                            <th>Cor</th>
                            <th>Ano</th>
                            <th>Placa</th>
                            <th>Vendedor</th>
                            <th>Acao</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query = "SELECT * FROM carros";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $carros)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $carros['id']; ?></td>
                                        <td><?= $carros['modelo']; ?></td>
                                        <td><?= $carros['cor']; ?></td>
                                        <td><?= $carros['ano']; ?></td>
                                        <td><?= $carros['placa']; ?></td>
                                        <td><?= $carros['id_vendedor']; ?></td>
                                        <td >
                                            <a href="consecionariaView.php?id=<?= $carros['id']; ?>" class="btn btn-info btn-sm">Visualizar</a>                                           
                                            <a href="consecionariaEdit.php?id=<?= $carros['id']; ?>" class="btn btn-success btn-sm">Editar</a>
                                            <form action="code.php" method="POST" class="d-inline">
                                                <button type="submit" name="delete_carro" value="<?=$carros['id'];?>" class="btn btn-danger btn-sm">Deletar</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                echo "<h5> Sem registros </h5>";
                            }
                        ?>

                <table class="table table-bordered table-striped"> <h2>Vendedores</h2>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>Acao</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query = "SELECT * FROM vendedores";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                foreach($query_run as $vendedores)
                                {
                                    ?>
                                    <tr>
                                        <td><?= $vendedores['id']; ?></td>
                                        <td><?= $vendedores['nome']; ?></td>
                                        <td><?= $vendedores['cpf']; ?></td>
                                        <td><?= $vendedores['email']; ?></td>
                                        <td><?= $vendedores['telefone']; ?></td>
                                        <td>
                                            <a href="vendedorView.php?id=<?= $vendedores['id']; ?>" class="btn btn-info btn-sm">Visualizar</a>                                           
                                            <a href="vendedorEdit.php?id=<?= $vendedores['id']; ?>" class="btn btn-success btn-sm">Editar</a>
                                            <form action="code.php" method="POST" class="d-inline">
                                                <button type="submit" name="delete_vendedor" value="<?=$vendedores['id'];?>" class="btn btn-danger btn-sm">Deletar</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            else
                            {
                                echo "<h5> Sem registros </h5>";
                            }
                        ?>
                        
                    </tbody>
                </table>
                <a href="logout.php" class="btn btn-danger">Logout</a>

            </div>
        </div>
    </div>
</div>
</div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>