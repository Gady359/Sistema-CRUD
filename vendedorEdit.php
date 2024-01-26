<?php
session_start();
require 'dbcon.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Vendedores Edicao</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <?php
            $sqlG = "SELECT ID, Nome FROM Vendedores";
                        $result = mysqli_query($con,$sqlG);
                        $optionsEspec = array();

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                array_push($optionsEspec, "\t\t\t<option value='" . $row["ID"] . "'>" . $row["Nome"] . "</option>\n");
                            }
                        } else {
                            echo "Erro executando SELECT: " . $conn->connect_error;
                        }

				?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Editar Vendedores
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                            $Vendedores_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM Vendedores WHERE id='$Vendedores_id' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $Vendedores = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="post">
                                    <input type="hidden" name="vendedores_id" value="<?= $Vendedores['id']; ?>">

                                    <div class="mb-3">
                                        <label>Nome</label>
                                        <input type="text" name="nome" value="<?=$Vendedores['nome'];?>" class="form-control" required required minlength="2" maxlength="40">
                                    </div>
                                    <div class="mb-3">
                                        <label>CPF</label>
                                        <input type="text" name="cpf" value="<?=$Vendedores['cpf'];?>" class="form-control" required minlength="11" maxlength="14">
                                    </div>
                                    <div class="mb-3">
                                        <label>Email</label>
                                        <input type="email" name="email" value="<?=$Vendedores['email'];?>" class="form-control" required >
                                    </div>
                                    <div class="mb-3">
                                        <label>Telefone</label>
                                        <input type="text" name="telefone" value="<?=$Vendedores['telefone'];?>" class="form-control" required minlength="7" maxlength="8">
                                    </div>
                
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="update_vendedor" class="btn btn-primary m-2">
                                            Atualizar Vendedores
                                        </button>
                                    </div>

                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>Id nao encontrado!</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>