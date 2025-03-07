<?php

try {
$myPDO = new PDO("pgsql:host=localhost;dbname=maquina","postgres","123456");
   echo "Esta conectado a la base de datos de PostgreSQL para maquina dispensadora";

} catch (PDOException $e) {
  echo $e -> getMessage();
}

 ?>

  --- C:\xampp\htdocs
