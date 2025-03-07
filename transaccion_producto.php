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
          <h1>BASE DE DATOS MAQUINA</h1>
          <h2>Formulario Trasaccion producto</h2>
        </div>
        <div class="panel-body">
          <form method="POST" action="transaccion_producto.php">
            <div class="form-group">
              <label for="id_transaccion">id transaccion</label>
              <input type="text" name="id_transaccion" class="form-control" id="id_transaccion">
            </div>
            <div class="form-group">
              <label for="id_producto">id producto</label>
              <input type="text" name="id_producto" class="form-control" id="id_producto">
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
            $id_producto = "";
 

            if(isset($_POST['btn_consultar'])) {
              $id_transaccion = $_POST['id_transaccion'];
              $exit = 0;

              if ($id_transaccion == "") {
                echo '<div class="alert alert-success">Se requiere el código del autor</div>';
              } else {
                $ver = $myPDO->query("SELECT * FROM transaccion_producto WHERE id_transaccion = $id_transaccion");
                while ($row = $ver->fetch()) {
                    echo '<div class="panel panel-default">';
                    echo '<div class="panel-heading"><h3>transaccion ID: ' . $row['id_transaccion'] . '</h3></div>';
                    echo '<div class="panel-body">';
                    echo '<p><strong>id_producto:</strong> ' . $row['id_producto'] . '</p>';
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
                $id_producto = $_POST['id_producto'];
            
                // Verificar que los campos obligatorios no estén vacíos
                if ($id_transaccion == "" || $id_producto == "") {
                    echo '<div class="alert alert-success">Los campos: id_transaccion y id_producto son obligatorios</div>';
                } else {
                    // Verificar que los campos numéricos tengan valores válidos
                    if (!is_numeric($id_transaccion)) {
                        echo '<div class="alert alert-success">El campo id_transaccion debe ser un número válido</div>';
                    } else {
                        try {
                            // Iniciar una transacción para garantizar consistencia
                            $myPDO->beginTransaction();
            
                            // Verificar si id_transaccion existe en la tabla transaccion
                            $check_query = $myPDO->prepare("SELECT COUNT(*) FROM transaccion WHERE id_transaccion = :id_transaccion");
                            $check_query->execute(['id_transaccion' => $id_transaccion]);
                            $exists = $check_query->fetchColumn();
            
                            if ($exists == 0) {
                                // Si no existe, insertar el id_transaccion en la tabla transaccion
                                $sql_insert_transaccion = "INSERT INTO transaccion (id_transaccion) VALUES (:id_transaccion)";
                                $insert_transaccion_query = $myPDO->prepare($sql_insert_transaccion);
                                $insert_transaccion_query->execute(['id_transaccion' => $id_transaccion]);
                                echo '<div class="alert alert-info">El id_transaccion no existía, pero se creó automáticamente en la tabla transaccion.</div>';
                            }
            
                            // Insertar el registro en la tabla transaccion_producto
                            $sql_insert_producto = "INSERT INTO transaccion_producto (id_transaccion, id_producto) VALUES (:id_transaccion, :id_producto)";
                            $insert_producto_query = $myPDO->prepare($sql_insert_producto);
                            $insert_producto_query->execute([
                                'id_transaccion' => $id_transaccion,
                                'id_producto' => $id_producto
                            ]);
            
                            // Confirmar la transacción
                            $myPDO->commit();
            
                            echo '<div class="alert alert-success">El registro se insertó correctamente en la tabla transaccion_producto</div>';
                        } catch (PDOException $e) {
                            // Revertir la transacción en caso de error
                            $myPDO->rollBack();
                            echo '<div class="alert alert-danger">Error al insertar el registro: ' . $e->getMessage() . '</div>';
                        }
                    }
                }
            }
            
            

            if(isset($_POST['btn_actualizar'])) {
              $id_transaccion = $_POST['id_transaccion'];
              $id_producto = $_POST['id_producto'];

              if ($id_transaccion == "") {
                echo '<div class="alert alert-success">Los campos: código, id_producto, apellido son obligatorios</div>';
              } else {
                $exit = 0;
                $ver = $myPDO->query("SELECT * FROM transaccion WHERE id_transaccion = '$id_transaccion'");
                while ($row = $ver->fetch()) {
                  $exit++;
                }
                if ($exit == 0) {
                  echo '<div class="alert alert-success">El código del autor no existe en la tabla</div>';
                } else {
                  $sql_update = "UPDATE transaccion_producto SET id_transaccion='$id_transaccion', id_producto='$id_producto'";
                  $myPDO->query($sql_update);
                  echo '<div class="alert alert-success">Actualización realizada</div>';
                }
              }
            }

            if (isset($_POST['btn_eliminar'])) {
                $id_transaccion = $_POST['id_transaccion'];
            
                if ($id_transaccion == "") {
                    echo '<div class="alert alert-success">Se requiere el código del autor</div>';
                } else {
                    // Verificar si el id_transaccion existe
                    $ver = $myPDO->prepare("SELECT COUNT(*) FROM transaccion WHERE id_transaccion = :id_transaccion");
                    $ver->execute(['id_transaccion' => $id_transaccion]);
                    $transaccion_existe = $ver->fetchColumn();
            
                    if ($transaccion_existe == 0) {
                        echo '<div class="alert alert-success">El código del autor no existe en la tabla</div>';
                    } else {
                        try {
                            // Iniciar una transacción para asegurar la consistencia
                            $myPDO->beginTransaction();
            
                            // Eliminar referencias en transaccion_producto
                            $sql_delete_transaccion_producto = "DELETE FROM transaccion_producto WHERE id_transaccion = :id_transaccion";
                            $stmt = $myPDO->prepare($sql_delete_transaccion_producto);
                            $stmt->execute(['id_transaccion' => $id_transaccion]);
            
                            // Eliminar registro en transaccion
                            $sql_delete_transaccion = "DELETE FROM transaccion WHERE id_transaccion = :id_transaccion";
                            $stmt = $myPDO->prepare($sql_delete_transaccion);
                            $stmt->execute(['id_transaccion' => $id_transaccion]);
            
                            // Confirmar la transacción
                            $myPDO->commit();
                            echo '<div class="alert alert-success">El registro se eliminó</div>';
                        } catch (PDOException $e) {
                            // Revertir los cambios si algo falla
                            $myPDO->rollBack();
                            echo '<div class="alert alert-danger">Error al eliminar el registro: ' . $e->getMessage() . '</div>';
                        }
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
