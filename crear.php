<?php
require_once 'servicios/db.php';
session_start();
// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Aquí debes verificar la información de inicio de sesión en tu base de datos o sistema de autenticación

  $usuario = $_POST["usuario"];
  $password = $_POST["password"];

  $sql = "SELECT id_docente, usuario, contrasena FROM docentes";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { ///el fetch_assoc() devuelve un array asociativo con los datos de la fila
      if ($usuario === $row["usuario"] && $password === $row["contrasena"]) {
        //guardar el id del docente en una sesión
        $_SESSION["id_docente"] = $row["id_docente"];
        header("Location: index.php");
        setcookie("logged_in", true, time() + 3600, "/");
        exit();
      } else {
        echo  "Usuario o contraseña incorrectos";
      }
    }
  } else {
    echo "0 results";
  }
}
?>