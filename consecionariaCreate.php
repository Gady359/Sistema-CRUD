<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AS2-Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-5">

    <?php require 'dbcon.php'; ?>

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
                        <h4>Adicionar Carro
                            <a href="index.php" class="btn btn-danger float-end">Voltar</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="post">
                            <div class="mb-3">
                                <label>Modelo</label>
                                <input type="text" name="modelo" class="form-control" required minlength="2" maxlength="40">
                            </div>
                            <div class="mb-3">
                                <label>Cor</label>
                                <input type="text" name="cor" class="form-control" required minlength="2" maxlength="20">
                            </div>
                            <div class="mb-3">
                                <label>Ano</label>
                                <input type="number" name="ano" class="form-control" required min="1886" max="2024">
                            </div>
                            <div class="mb-3">
                                <label>Placa</label>
                                <input type="text" name="placa" class="form-control" required minlength="7" maxlength="8">
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
                                <button type="submit" name="save_carro" class="btn btn-primary">Adicionar Carro</button>
                            </div>
                                                        
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>