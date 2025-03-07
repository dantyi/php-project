<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #74ebd5, #acb6e5);
      font-family: 'Arial', sans-serif;
      color: #ffffff;
    }

    .container {
      margin-top: 50px;
    }

    .card {
      background-color: #2c3e50;
      border: none;
      border-radius: 15px;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: scale(1.03);
      box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.5);
    }

    .card-header {
      background-color: #007bff;
      color: white;
      font-size: 1.5rem;
      font-weight: bold;
      text-align: center;
      padding: 1rem;
    }

    .card-body {
      padding: 2rem;
    }

    .form-group label {
      font-weight: bold;
      color: #99f2c8;
    }

    .form-control {
      background-color: #34495e;
      color: #fff;
      border: 1px solid #99f2c8;
      border-radius: 5px;
      padding: 0.75rem;
    }

    .btn {
      width: 100%;
      padding: 0.75rem;
      margin-top: 1rem;
      font-size: 1rem;
      font-weight: bold;
      border-radius: 5px;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn:hover {
      transform: translateY(-2px);
    }

    .btn-primary {
      background-color: #007bff;
      border: none;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }

    .btn-success {
      background-color: #28a745;
      border: none;
    }

    .btn-success:hover {
      background-color: #1c7c34;
    }

    .btn-info {
      background-color: #17a2b8;
      border: none;
    }

    .btn-info:hover {
      background-color: #117a8b;
    }

    .btn-danger {
      background-color: #dc3545;
      border: none;
    }

    .btn-danger:hover {
      background-color: #a71d2a;
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
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header">
            BASE DE DATOS CARRITO - Formulario Ciudad/Municipio
          </div>
          <div class="card-body">
            <form method="POST" action="">
              <div class="form-group mb-3">
                <label for="id_ciudad_muni">Código Ciudad/Municipio</label>
                <input type="text" name="id_ciudad_muni" class="form-control" id="id_ciudad_muni">
              </div>
              <div class="form-group mb-3">
                <label for="ciudad_municipio">Nombre Ciudad/Municipio</label>
                <input type="text" name="ciudad_municipio" class="form-control" id="ciudad_municipio">
              </div>
              <div class="form-group mb-3">
                <label for="id_departamento">ID Departamento</label>
                <input type="text" name="id_departamento" class="form-control" id="id_departamento">
              </div>
              <div class="row">
                <div class="col-md-3">
                  <button type="submit" class="btn btn-primary" name="btn_consultar">Consultar</button>
                </div>
                <div class="col-md-3">
                  <button type="submit" class="btn btn-success" name="btn_nuevo">Nuevo</button>
                </div>
                <div class="col-md-3">
                  <button type="submit" class="btn btn-info" name="btn_actualizar">Actualizar</button>
                </div>
                <div class="col-md-3">
                  <button type="submit" class="btn btn-danger" name="btn_eliminar">Eliminar</button>
                </div>
              </div>
            </form>

            <?php
              include("conexion.php");

              $id_ciudad_muni = "";
              $ciudad_municipio = "";
              $id_departamento = "";

              if (isset($_POST['btn_consultar'])) {
                  $id_ciudad_muni = $_POST['id_ciudad_muni'];
                  if ($id_ciudad_muni == "") {
                      echo '<div class="alert alert-warning mt-3">Por favor, ingrese el código de ciudad/municipio.</div>';
                  } else {
                      $query = $myPDO->prepare("SELECT * FROM ciudad_municipio WHERE id_ciudad_muni = ?");
                      $query->execute([$id_ciudad_muni]);
                      $result = $query->fetch();
                      if ($result) {
                          echo "<div class='alert alert-info mt-3'>Datos Encontrados:<br>Ciudad/Municipio: {$result['ciudad_municipio']}<br>ID Departamento: {$result['id_departamento']}</div>";
                      } else {
                          echo '<div class="alert alert-danger mt-3">No se encontraron datos para el código ingresado.</div>';
                      }
                  }
              }

              if (isset($_POST['btn_nuevo'])) {
                  $id_ciudad_muni = $_POST['id_ciudad_muni'];
                  $ciudad_municipio = $_POST['ciudad_municipio'];
                  $id_departamento = $_POST['id_departamento'];
                  if ($id_ciudad_muni && $ciudad_municipio && $id_departamento) {
                      $query = $myPDO->prepare("INSERT INTO ciudad_municipio (id_ciudad_muni, ciudad_municipio, id_departamento) VALUES (?, ?, ?)");
                      $query->execute([$id_ciudad_muni, $ciudad_municipio, $id_departamento]);
                      echo '<div class="alert alert-success mt-3">Nuevo registro creado exitosamente.</div>';
                  } else {
                      echo '<div class="alert alert-warning mt-3">Por favor, complete todos los campos.</div>';
                  }
              }

              if (isset($_POST['btn_actualizar'])) {
                  $id_ciudad_muni = $_POST['id_ciudad_muni'];
                  $ciudad_municipio = $_POST['ciudad_municipio'];
                  $id_departamento = $_POST['id_departamento'];
                  if ($id_ciudad_muni && $ciudad_municipio && $id_departamento) {
                      $query = $myPDO->prepare("UPDATE ciudad_municipio SET ciudad_municipio = ?, id_departamento = ? WHERE id_ciudad_muni = ?");
                      $query->execute([$ciudad_municipio, $id_departamento, $id_ciudad_muni]);
                      echo '<div class="alert alert-success mt-3">Registro actualizado exitosamente.</div>';
                  } else {
                      echo '<div class="alert alert-warning mt-3">Por favor, complete todos los campos.</div>';
                  }
              }

              if (isset($_POST['btn_eliminar'])) {
                  $id_ciudad_muni = $_POST['id_ciudad_muni'];
                  if ($id_ciudad_muni) {
                      $query = $myPDO->prepare("DELETE FROM ciudad_municipio WHERE id_ciudad_muni = ?");
                      $query->execute([$id_ciudad_muni]);
                      echo '<div class="alert alert-success mt-3">Registro eliminado exitosamente.</div>';
                  } else {
                      echo '<div class="alert alert-warning mt-3">Por favor, ingrese el código a eliminar.</div>';
                  }
              }
            ?>
          </div>
        </div>
      </div>
    </div>
    <div class="footer">
  <a href="index.html" class="btn-back">Regresar</a>
</div>
  </div>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
