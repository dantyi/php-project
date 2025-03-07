<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <style>
    body {
      background: linear-gradient(135deg, #74ebd5, #acb6e5);
      font-family: 'Arial', sans-serif;
      color: #fff;
    }
    .container {
      margin-top: 50px;
    }
    .panel-heading {
      background-color: #007bff;
      color: white;
      border-radius: 10px 10px 0 0;
      padding: 15px;
    }
    .panel-body {
      background-color: #2c3e50;
      border-radius: 0 0 10px 10px;
      padding: 20px;
    }
    .form-group label {
      font-weight: bold;
      color: #99f2c8;
    }
    .form-control {
      background-color: #34495e;
      color: #fff;
      border: none;
      border-radius: 5px;
    }
    .btn-primary:hover,
    .btn-success:hover,
    .btn-info:hover,
    .btn-danger:hover {
      transform: translateY(-3px);
    }
    
    .footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #2c3e50;
    text-align: center;
    padding: 10px 0;
    box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.2);
  }

  .btn-back {
    font-size: 16px;
    font-weight: bold;
    color: #fff;
    text-decoration: none;
    background-color: #007bff;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    display: inline-block;
    transition: background-color 0.3s ease, transform 0.2s ease;
  }

  .btn-back:hover {
    background-color: #0056b3;
    transform: translateY(-3px);
  }
  </style>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h1>BASE DE DATOS MAQUINA</h1>
          <h2>Formulario máquina</h2>
        </div>
        <div class="panel-body">
          <form method="POST" action="">
            <div class="form-group">
              <label for="id_maquina">Código máquina</label>
              <input type="text" name="id_maquina" class="form-control" id="id_maquina">
            </div>
            <div class="form-group">
              <label for="modelo">Modelo máquina</label>
              <input type="text" name="modelo" class="form-control" id="modelo">
            </div>
            <div class="form-group">
              <label for="serie">Serie máquina</label>
              <input type="text" name="serie" class="form-control" id="serie">
            </div>
            <div class="form-group">
              <label for="estado">Estado Electrónico</label>
              <input type="text" name="estado" class="form-control" id="estado">
            </div>
            <div class="form-group">
              <label for="id_municipio">ID Municipio</label>
              <input type="text" name="id_municipio" class="form-control" id="id_municipio">
            </div>
            <div class="text-center">
              <input type="submit" value="Consultar" class="btn btn-primary" name="btn_consultar">
              <input type="submit" value="Nuevo" class="btn btn-success" name="btn_nuevo">
              <input type="submit" value="Actualizar" class="btn btn-info" name="btn_actualizar">
              <input type="submit" value="Eliminar" class="btn btn-danger" name="btn_eliminar">
            </div>
          </form>

          <?php
            include("conexion.php");

            $id_maquina = $_POST['id_maquina'] ?? "";
            $modelo = $_POST['modelo'] ?? "";
            $serie = $_POST['serie'] ?? "";
            $estado = $_POST['estado'] ?? "";
            $id_municipio = $_POST['id_municipio'] ?? "";

            if (isset($_POST['btn_consultar'])) {
              if ($id_maquina === "") {
                echo '<div class="alert alert-danger">Se requiere el código de la máquina</div>';
              } else {
                $query = $myPDO->query("SELECT * FROM maquina_disp WHERE id_maquina = '$id_maquina'");
                if ($query->rowCount() > 0) {
                  while ($row = $query->fetch()) {
                    echo "<div class='alert alert-info'>
                            <strong>Modelo:</strong> {$row['modelo']} <br>
                            <strong>Serie:</strong> {$row['serie']} <br>
                            <strong>Estado:</strong> {$row['estado']} <br>
                            <strong>ID Municipio:</strong> {$row['id_municipio']}
                          </div>";
                  }
                } else {
                  echo '<div class="alert alert-warning">No se encontraron resultados</div>';
                }
              }
            }

            if (isset($_POST['btn_nuevo'])) {
              if ($id_maquina === "" || $modelo === "" || $serie === "") {
                echo '<div class="alert alert-danger">Los campos Código, Modelo y Serie son obligatorios</div>';
              } else {
                $sql = "INSERT INTO maquina_disp (id_maquina, modelo, serie, estado, id_municipio)
                        VALUES ('$id_maquina', '$modelo', '$serie', '$estado', '$id_municipio')";
                if ($myPDO->query($sql)) {
                  echo '<div class="alert alert-success">Registro creado exitosamente</div>';
                } else {
                  echo '<div class="alert alert-danger">Error al crear el registro</div>';
                }
              }
            }

            if (isset($_POST['btn_actualizar'])) {
              if ($id_maquina === "" || $modelo === "" || $serie === "") {
                echo '<div class="alert alert-danger">Los campos Código, Modelo y Serie son obligatorios</div>';
              } else {
                $sql = "UPDATE maquina_disp 
                        SET modelo = '$modelo', serie = '$serie', estado = '$estado', id_municipio = '$id_municipio'
                        WHERE id_maquina = '$id_maquina'";
                if ($myPDO->query($sql)) {
                  echo '<div class="alert alert-success">Registro actualizado exitosamente</div>';
                } else {
                  echo '<div class="alert alert-danger">Error al actualizar el registro</div>';
                }
              }
            }

            if (isset($_POST['btn_eliminar'])) {
              if ($id_maquina === "") {
                echo '<div class="alert alert-danger">Se requiere el Código de la máquina</div>';
              } else {
                $sql = "DELETE FROM maquina_disp WHERE id_maquina = '$id_maquina'";
                if ($myPDO->query($sql)) {
                  echo '<div class="alert alert-success">Registro eliminado exitosamente</div>';
                } else {
                  echo '<div class="alert alert-danger">Error al eliminar el registro</div>';
                }
              }
            }
          ?>
        </div>
      </div>
    </div>
    <div class="col-md-2"></div>
  </div>
  <div class="footer">
  <a href="index.html" class="btn-back">Regresar</a>
</div>
</div>
</body>
</html>
