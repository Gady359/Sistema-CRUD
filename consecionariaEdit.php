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

    <title>Carros Edicao</title>
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
                        <h4>Carros Edicao
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['id']))
                        {
                            $carros_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM carros WHERE id='$carros_id' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $carros = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="post">
                                    <input type="hidden" name="carros_id" value="<?= $carros['id']; ?>">

                                    <div class="mb-3">
                                        <label>Modelo</label>
                                        <input type="text" name="modelo" value="<?=$carros['modelo'];?>" class="form-control" required required minlength="2" maxlength="40">
                                    </div>
                                    <div class="mb-3">
                                        <label>Cor</label>
                                        <input type="text" name="cor" value="<?=$carros['cor'];?>" class="form-control" required minlength="2" maxlength="20">
                                    </div>
                                    <div class="mb-3">
                                        <label>Ano</label>
                                        <input type="number" name="ano" value="<?=$carros['ano'];?>" class="form-control" required min="1886" max="2024">
                                    </div>
                                    <div class="mb-3">
                                        <label>Placa</label>
                                        <input type="text" name="placa" value="<?=$carros['placa'];?>" class="form-control" required minlength="7" maxlength="8">
                                    </div>
                                    <div class="mb-3">
                                        <label>Vendedor</label>
                                        <br>
                                        <select name="vendedor" id="vendedor" required>
                                        <option value=""></option>
                                        <?php
                                        foreach ($optionsEspec as $key => $value) {
                                            echo $value;
                                        }
                                        ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="update_carro" class="btn btn-primary">
                                            Atualizar carros
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