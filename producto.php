<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Modernizado</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #74ebd5, #acb6e5);
      font-family: 'Roboto', sans-serif;
      color: #fff;
    }
    .container {
      margin-top: 50px;
    }
    .panel {
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      border-radius: 10px;
      overflow: hidden;
    }
    .panel-heading {
      background-color: #2b6777;
      color: white;
      text-align: center;
      padding: 20px;
    }
    .panel-heading h1, .panel-heading h2 {
      margin: 0;
    }
    .panel-body {
      background-color: #1c1c1e;
      padding: 20px;
    }
    .form-group label {
      font-weight: bold;
      color: #87eec7;
    }
    .form-control {
      background-color: #2b2b2b;
      color: #fff;
      border: 1px solid #444;
      border-radius: 5px;
    }
    .form-control:focus {
      border-color: #87eec7;
      box-shadow: 0 0 5px rgba(135, 238, 199, 0.5);
    }
    .btn {
      margin: 10px 5px;
      padding: 10px 20px;
      border-radius: 5px;
      transition: all 0.3s ease;
    }
    .btn:hover {
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }
    .alert {
      margin-top: 20px;
      border-radius: 5px;
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
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h1>Base de Datos Carrito</h1>
          <h2>Formulario Producto</h2>
        </div>
        <div class="panel-body">
          <form method="POST" action="producto.php">
            <div class="form-group">
              <label for="id_producto">Código Producto</label>
              <input type="text" name="id_producto" class="form-control" id="id_producto">
            </div>
            <div class="form-group">
              <label for="tipo">Tipo Producto</label>
              <input type="text" name="tipo" class="form-control" id="tipo">
            </div>
            <div class="form-group">
              <label for="nombre">Nombre Producto</label>
              <input type="text" name="nombre" class="form-control" id="nombre">
            </div>
            <div class="form-group">
              <label for="precio">Precio producto</label>
              <input type="text" name="precio" class="form-control" id="precio">
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

            $id_producto = "";
            $tipo = "";
            $nombre = "";
            $precio = "";
  


            if(isset($_POST['btn_consultar'])) {
              $id_producto = $_POST['id_producto'];
              $exit = 0;

              if ($id_producto == "") {
                echo '<div class="alert alert-success">Se requiere el código del autor</div>';
              } else {
                $ver = $myPDO->query("SELECT * FROM producto WHERE id_producto = $id_producto");
                while ($row = $ver->fetch()) {
                    echo '<div class="panel panel-default">';
                    echo '<div class="panel-heading"><h3>producto ID: ' . $row['id_producto'] . '</h3></div>';
                    echo '<div class="panel-body">';
                    echo '<p><strong>tipo:</strong> ' . $row['tipo'] . '</p>';
                    echo '<p><strong>nombre:</strong> ' . $row['nombre'] . '</p>';
                    echo '<p><strong>precio:</strong> ' . $row['precio'] . '</p>';
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
                $id_producto = $_POST['id_producto'];
                $tipo = $_POST['tipo'];
                $nombre = $_POST['nombre'];
                $precio = $_POST['precio'];
  
                // Verificar que los campos obligatorios no estén vacíos
                if ($id_producto == "" || $tipo == "" ) {
                  echo '<div class="alert alert-success">Los campos: código, tipo, nombre son obligatorios</div>';
                } else {
                  // Verificar que los campos numéricos tengan valores válidos
                  if (!is_numeric($id_producto)) {
                    echo '<div class="alert alert-success">Los campos: código, teléfono y código deben ser números válidos</div>';
                  } else {
                    $sql_insert = "INSERT INTO producto(id_producto, tipo, nombre, precio) VALUES ('$id_producto', '$tipo', '$nombre', '$precio')";
                    $myPDO->query($sql_insert);
                    echo '<div class="alert alert-success">El producto se registró en la tabla</div>';
                  }
                }              
              }
            
            

            if(isset($_POST['btn_actualizar'])) {
              $id_producto = $_POST['id_producto'];
              $tipo = $_POST['tipo'];
              $nombre = $_POST['nombre'];
              $precio = $_POST['precio'];



              if ($id_producto == "" || $tipo == "" || $nombre == "") {
                echo '<div class="alert alert-success">Los campos: código, tipo, nombre son obligatorios</div>';
              } else {
                $exit = 0;
                $ver = $myPDO->query("SELECT * FROM producto WHERE id_producto = '$id_producto'");
                while ($row = $ver->fetch()) {
                  $exit++;
                }
                if ($exit == 0) {
                  echo '<div class="alert alert-success">El código del autor no existe en la tabla</div>';
                } else {
                  $sql_update = "UPDATE producto SET id_producto='$id_producto', tipo='$tipo', nombre='$nombre', precio='$precio' WHERE id_producto='$id_producto'";
                  $myPDO->query($sql_update);
                  echo '<div class="alert alert-success">Actualización realizada</div>';
                }
              }
            }

            if (isset($_POST['btn_eliminar'])) {
                $id_producto = $_POST['id_producto'];
                $exit = 0;
            
                if ($id_producto == "") {
                    echo '<div class="alert alert-success">Se requiere el código del autor</div>';
                } else {
                    // Verificamos si el registro existe en la tabla producto
                    $ver = $myPDO->query("SELECT * FROM producto WHERE id_producto = '$id_producto'");
                    while ($row = $ver->fetch()) {
                        $exit++;
                    }
                    if ($exit == 0) {
                        echo '<div class="alert alert-success">El código del autor no existe en la tabla</div>';
                    } else {
                        // Primero eliminamos los registros en producto_producto
                        $sql_delete_producto_producto = "DELETE FROM producto_producto WHERE id_producto = '$id_producto'"; 
                        $myPDO->query($sql_delete_producto_producto);
            
                        // Luego eliminamos el registro en producto
                        $sql_delete_carrito = "DELETE FROM producto WHERE id_producto = '$id_producto'"; 
                        $myPDO->query($sql_delete_carrito);
            
                        echo '<div class="alert alert-success">El registro se eliminó correctamente</div>';
                    }
                }
            }
          ?>
        </div>
      </div>
    </div>
    <div class="footer">
  <a href="index.html" class="btn-back">Regresar</a>
</div>
  </div>
</div>
</body>
</html>
