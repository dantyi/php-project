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
    }
    .panel-body {
      background-color: #2c3e50;
      border-radius: 0 0 10px 10px;
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
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    .btn-success {
      background-color: #28a745;
      border-color: #28a745;
    }
    .btn-info {
      background-color: #17a2b8;
      border-color: #17a2b8;
    }
    .btn-danger {
      background-color: #dc3545;
      border-color: #dc3545;
    }
    .alert {
      margin-top: 20px;
    }
    .btn {
      font-size: 16px;
      font-weight: bold;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 10px 20px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    /* Botón primario (azul) */
    .btn-primary {
      background-color: #007bff;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      transform: translateY(-3px);
    }

    /* Botón de éxito (verde) */
    .btn-success {
      background-color: #28a745;
    }
    .btn-success:hover {
      background-color: #218838;
      transform: translateY(-3px);
    }

    /* Botón de información (celeste) */
    .btn-info {
      background-color: #17a2b8;
    }
    .btn-info:hover {
      background-color: #117a8b;
      transform: translateY(-3px);
    }

    /* Botón de peligro (rojo) */
    .btn-danger {
      background-color: #dc3545;
    }
    .btn-danger:hover {
      background-color: #c82333;
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
          <h2>Formulario usuario</h2>
        </div>
        <div class="panel-body">
          <form method="POST" action="usuario.php">
            <div class="form-group">
              <label for="id_usuario">Código usuario</label>
              <input type="text" name="id_usuario" class="form-control" id="id_usuario">
            </div>
            <div class="form-group">
              <label for="nombre">Nombre usuario</label>
              <input type="text" name="nombre" class="form-control" id="nombre">
            </div>
            <div class="form-group">
              <label for="correo">Correo Electrónico</label>
              <input type="email" name="correo" class="form-control" id="correo">
            </div>
            <div class="form-group">
              <label for="celular">celular usuario</label>
              <input type="text" name="celular" class="form-control" id="celular">
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

            $id_usuario = "";
            $nombre = "";
            $correo = "";
            $celular = "";

            if(isset($_POST['btn_consultar'])) {
              $id_usuario = $_POST['id_usuario'];
              $exit = 0;

              if ($id_usuario == "") {
                echo '<div class="alert alert-success">Se requiere el código del usuario</div>';
              } else {
                $ver = $myPDO->query("SELECT * FROM usuario WHERE id_usuario = $id_usuario");
                while ($row = $ver->fetch()) {
                    echo '<div class="panel panel-default">';
                    echo '<div class="panel-heading"><h3>usuario ID: ' . $row['id_usuario'] . '</h3></div>';
                    echo '<div class="panel-body">';
                    echo '<p><strong>Nombre:</strong> ' . $row['nombre'] . '</p>';
                    echo '<p><strong>Correo:</strong> ' . $row['correo'] . '</p>';
                    echo '<p><strong>Dirección:</strong> ' . $row['celular'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                  $exit++;
                }
                if ($exit == 0) {
                  echo '<div class="alert alert-success">El código del autor no existe en la tabla</div>';
                }
              }
            }

            if(isset($_POST['btn_nuevo'])) {
              $id_usuario = $_POST['id_usuario'];
              $nombre = $_POST['nombre'];
              $correo = $_POST['correo'];
              $celular = $_POST['celular'];
              
              // Verificar que los campos obligatorios no estén vacíos
              if ($id_usuario == "") {
                echo '<div class="alert alert-success">Los campos: código, nombre, apellido son obligatorios</div>';
              } else {
                // Verificar que los campos numéricos tengan valores válidos
                if (!is_numeric($id_usuario) || !is_numeric($celular)) {
                  echo '<div class="alert alert-success">Los campos: código, teléfono y código deben ser números válidos</div>';
                } else {
                  $sql_insert = "INSERT INTO usuario(id_usuario, nombre, correo, celular) VALUES ('$id_usuario', '$nombre', '$correo', '$celular')";
                  $myPDO->query($sql_insert);
                  echo '<div class="alert alert-success">El usuario se registró en la tabla</div>';
                }
              }              
            }

            if(isset($_POST['btn_actualizar'])) {
              $id_usuario = $_POST['id_usuario'];
              $nombre = $_POST['nombre'];
              $correo = $_POST['correo'];
              $celular = $_POST['celular'];
     

              if ($id_usuario == "") {
                echo '<div class="alert alert-success">Los campos: código, nombre, apellido son obligatorios</div>';
              } else {
                $exit = 0;
                $ver = $myPDO->query("SELECT * FROM usuario WHERE id_usuario = '$id_usuario'");
                while ($row = $ver->fetch()) {
                  $exit++;
                }
                if ($exit == 0) {
                  echo '<div class="alert alert-success">El código del autor no existe en la tabla</div>';
                } else {
                  $sql_update = "UPDATE usuario SET id_usuario='$id_usuario', nombre='$nombre', correo='$correo', celular ='$celular' WHERE id_usuario='$id_usuario'";
                  $myPDO->query($sql_update);
                  echo '<div class="alert alert-success">Actualización realizada</div>';
                }
              }
            }

            if (isset($_POST['btn_eliminar'])) {
              $id_usuario = $_POST['id_usuario'];
              $exit = 0;
          
              if ($id_usuario == "") {
                  echo '<div class="alert alert-success">Se requiere el código del autor</div>';
              } else {
                  // Verificar si el usuario existe
                  $ver = $myPDO->query("SELECT * FROM usuario WHERE id_usuario = '$id_usuario'");
                  while ($row = $ver->fetch()) {
                      $exit++;
                  }
          
                  if ($exit == 0) {
                      echo '<div class="alert alert-success">El código del autor no existe en la tabla</div>';
                  } else {
                      // Eliminar registros relacionados en transaccion_producto
                      $sql_delete_productos = "DELETE FROM transaccion_producto WHERE id_transaccion IN 
                          (SELECT id_transaccion FROM transaccion WHERE id_usuario='$id_usuario')";
                      $myPDO->query($sql_delete_productos);
          
                      // Eliminar registros en transaccion
                      $sql_delete_carrito = "DELETE FROM transaccion WHERE id_usuario='$id_usuario'";
                      $myPDO->query($sql_delete_carrito);
          
                      // Eliminar el usuario
                      $sql_delete_usuario = "DELETE FROM usuario WHERE id_usuario='$id_usuario'";
                      $myPDO->query($sql_delete_usuario);
          
                      echo '<div class="alert alert-success">El registro se eliminó</div>';
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
