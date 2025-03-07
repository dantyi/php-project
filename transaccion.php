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
          <h1>BASE DE DATOS CARRITO</h1>
          <h2>Formulario transaccion</h2>
        </div>
        <div class="panel-body">
          <form method="POST" action="transaccion.php">
            <div class="form-group">
              <label for="id_transaccion">Código transaccion</label>
              <input type="text" name="id_transaccion" class="form-control" id="id_transaccion">
            </div>
            <div class="form-group">
              <label for="fecha">fecha transaccion</label>
              <input type="text" name="fecha" class="form-control" id="fecha">
            </div>
            <div class="form-group">
              <label for="hora">hora transaccion</label>
              <input type="text" name="hora" class="form-control" id="hora">
            </div>
            <div class="form-group">
              <label for="id_usuario">id usuario</label>
              <input type="text" name="id_usuario" class="form-control" id="id_usuario">
            </div>
            <div class="form-group">
              <label for="id_maquina">id maquina</label>
              <input type="text" name="id_maquina" class="form-control" id="id_maquina">
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
            $id_transaccion = "";
            $fecha = "";
            $hora = "";
            $id_usuario = "";
            $id_maquina = "";


            if(isset($_POST['btn_consultar'])) {
              $id_transaccion = $_POST['id_transaccion'];
              $exit = 0;

              if ($id_transaccion == "") {
                echo '<div class="alert alert-success">Se requiere el código del autor</div>';
              } else {
                $ver = $myPDO->query("SELECT * FROM transaccion WHERE id_transaccion = $id_transaccion");
                while ($row = $ver->fetch()) {
                    echo '<div class="panel panel-default">';
                    echo '<div class="panel-heading"><h3>transaccion ID: ' . $row['id_transaccion'] . '</h3></div>';
                    echo '<div class="panel-body">';
                    echo '<p><strong>fecha:</strong> ' . $row['fecha'] . '</p>';
                    echo '<p><strong>hora:</strong> ' . $row['hora'] . '</p>';
                    echo '<p><strong>id_usuario:</strong> ' . $row['id_usuario'] . '</p>';
                    echo '<p><strong>Teléfono:</strong> ' . $row['id_maquina'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                  $exit++;
                }
                if ($exit == 0) {
                  echo '<div class="alert alert-success">El código del autor no existe en la tabla</div>';
                }
              }
            }

            if (isset($_POST['btn_nuevo'])) {
                $id_transaccion = $_POST['id_transaccion'];
                $fecha = $_POST['fecha'];
                $hora = $_POST['hora'];
                $id_usuario = $_POST['id_usuario'];
                $id_maquina = $_POST['id_maquina'];
                // Verificar que los campos obligatorios no estén vacíos
                if ($id_transaccion == "" || $fecha == "" || $hora == "") {
                    echo '<div class="alert alert-danger">Los campos: código, fecha, hora son obligatorios</div>';
                } else {
                    // Verificar que los campos numéricos tengan valores válidos
                    if (!is_numeric($id_transaccion) || !is_numeric($id_maquina)) {
                        echo '<div class="alert alert-danger">Los campos: código y id_maquina deben ser números válidos</div>';
                    } else {
                        // Verificar si ya existe la transacción en la base de datos
                        $sql_check = "SELECT * FROM transaccion WHERE id_transaccion = :id_transaccion";
                        $stmt = $myPDO->prepare($sql_check);
                        $stmt->execute(['id_transaccion' => $id_transaccion]);
                        $row = $stmt->fetch();
            
                        if ($row) {
                            // Si ya existe la transacción, se verifica si alguno de los campos está en NULL
                            $update_needed = false;
                            if (is_null($row['fecha']) || is_null($row['hora']) || is_null($row['id_usuario']) || is_null($row['id_maquina'])) {
                                $update_needed = true;
                            }
            
                            if ($update_needed) {
                                // Actualizar los campos si alguno está en NULL
                                $sql_update = "UPDATE transaccion 
                                               SET fecha = COALESCE(:fecha, fecha),
                                                   hora = COALESCE(:hora, hora),
                                                   id_usuario = COALESCE(:id_usuario, id_usuario),
                                                   id_maquina = COALESCE(:id_maquina, id_maquina)
                                               WHERE id_transaccion = :id_transaccion";
                                $stmt_update = $myPDO->prepare($sql_update);
                                $stmt_update->execute([
                                    'id_transaccion' => $id_transaccion,
                                    'fecha' => $fecha,
                                    'hora' => $hora,
                                    'id_usuario' => $id_usuario,
                                    'id_maquina' => $id_maquina
                                ]);
                                echo '<div class="alert alert-success">La transacción se actualizó correctamente.</div>';
                            } else {
                                echo '<div class="alert alert-info">La transacción ya existe y no tiene valores NULL que actualizar.</div>';
                            }
                        } else {
                            // Si la transacción no existe, insertarla
                            $sql_insert = "INSERT INTO transaccion(id_transaccion, fecha, hora, id_usuario, id_maquina) 
                                           VALUES (:id_transaccion, :fecha, :hora, :id_usuario, :id_maquina)";
                            $stmt_insert = $myPDO->prepare($sql_insert);
                            $stmt_insert->execute([
                                'id_transaccion' => $id_transaccion,
                                'fecha' => $fecha,
                                'hora' => $hora,
                                'id_usuario' => $id_usuario,
                                'id_maquina' => $id_maquina
                            ]);
                            echo '<div class="alert alert-success">La transacción se registró correctamente.</div>';
                        }
                    }
                }
            }
            
            

            if(isset($_POST['btn_actualizar'])) {
              $id_transaccion = $_POST['id_transaccion'];
              $fecha = $_POST['fecha'];
              $hora = $_POST['hora'];
              $id_usuario = $_POST['id_usuario'];
              $id_maquina = $_POST['id_maquina'];


              if ($id_transaccion == "" || $fecha == "" || $hora == "") {
                echo '<div class="alert alert-success">Los campos: código, fecha, hora son obligatorios</div>';
              } else {
                $exit = 0;
                $ver = $myPDO->query("SELECT * FROM transaccion WHERE id_transaccion = '$id_transaccion'");
                while ($row = $ver->fetch()) {
                  $exit++;
                }
                if ($exit == 0) {
                  echo '<div class="alert alert-success">El código del autor no existe en la tabla</div>';
                } else {
                  $sql_update = "UPDATE transaccion SET id_transaccion='$id_transaccion', fecha='$fecha', hora='$hora', id_usuario='$id_usuario', id_maquina ='$id_maquina'  WHERE id_transaccion='$id_transaccion'";
                  $myPDO->query($sql_update);
                  echo '<div class="alert alert-success">Actualización realizada</div>';
                }
              }
            }

            if (isset($_POST['btn_eliminar'])) {
                $id_transaccion = $_POST['id_transaccion'];
                $exit = 0;
            
                if ($id_transaccion == "") {
                    echo '<div class="alert alert-success">Se requiere el código del autor</div>';
                } else {
                    // Verificamos si el registro existe en la tabla transaccion
                    $ver = $myPDO->query("SELECT * FROM transaccion WHERE id_transaccion = '$id_transaccion'");
                    while ($row = $ver->fetch()) {
                        $exit++;
                    }
                    if ($exit == 0) {
                        echo '<div class="alert alert-success">El código del autor no existe en la tabla</div>';
                    } else {
                        // Primero eliminamos los registros en transaccion_producto
                        $sql_delete_transaccion_producto = "DELETE FROM transaccion_producto WHERE id_transaccion = '$id_transaccion'"; 
                        $myPDO->query($sql_delete_transaccion_producto);
            
                        // Luego eliminamos el registro en transaccion
                        $sql_delete_carrito = "DELETE FROM transaccion WHERE id_transaccion = '$id_transaccion'"; 
                        $myPDO->query($sql_delete_carrito);
            
                        echo '<div class="alert alert-success">El registro se eliminó correctamente</div>';
                    }
                }
            }
          ?>
        </div>
      </div>
    </div>
    <div class="col-md-2"></div>
  </div>
</div>
<div class="footer">
  <a href="index.html" class="btn-back">Regresar</a>
</div>
</body>
</html>
