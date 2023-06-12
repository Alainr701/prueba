<?php
require_once 'servicios/db.php';

// Verificar si se recibieron los datos de asistencia
if (isset($_POST['submit']) && isset($_POST['id_estudiante']) && isset($_POST['fecha']) && isset($_POST['asistencia']) && isset($_POST['id_materia']) && isset($_POST['id_docente'])) {
  // Obtener los datos de asistencia del formulario
  $id_estudiantes = $_POST['id_estudiante'];
  $fecha = $_POST['fecha'];
  $asistencia = $_POST['asistencia'];
  $materia = $_POST['id_materia'];
  $id_docente = $_POST['id_docente'];
  //IMPRIMIR DATOS
  // print_r($id_estudiantes);
  // echo "FECHA: " . $fecha . "<br>";
  // print_r($asistencia);
  // echo "MATERIA: " . $materia . "<br>";

  // Verificar si los valores recibidos son arrays
  if (is_array($id_estudiantes) && is_array($asistencia)) {
    // Recorrer los datos y guardarlos en la base de datos
    for ($i = 0; $i < count($id_estudiantes); $i++) {
      $id_estudiante = $id_estudiantes[$i];
      $asistio = $asistencia[$i];

      // Verificar si ya existe una entrada de asistencia para la fecha actual y el estudiante actual
      $query = "SELECT id_asistencia FROM asistencia WHERE id_estudiante = '$id_estudiante' AND fecha = '$fecha' AND id_materia = '$materia' AND id_docente = '$id_docente'"; 
      $result = $conn->query($query);

      if ($result->num_rows > 0) {
        // Actualizar la entrada existente
        $row = $result->fetch_assoc();
        $id_asistencia = $row["id_asistencia"];

        $sql = "UPDATE asistencia SET asistencia = '$asistio' WHERE id_asistencia = '$id_asistencia'  AND id_materia = '$materia' AND id_docente = '$id_docente'";
        $result = $conn->query($sql);

        if ($result) {
          echo "Asistencia actualizada correctamente.";
          header("Location: index.php");
        } else {
          echo "Error al actualizar la asistencia: " . $conn->error;
        }
      } else {
        // Insertar una nueva entrada de asistencia
        $sql = "INSERT INTO asistencia (id_estudiante, id_materia, fecha, asistencia, id_docente) VALUES ('$id_estudiante', '$materia', '$fecha', '$asistio', '$id_docente')";
        $result = $conn->query($sql);

        if ($result) {
          echo "Asistencia guardada correctamente.";
          header("Location: index.php");
        } else {
          echo "Error al guardar la asistencia: " . $conn->error;
        }
      }
    }
  } else {
    echo "Los datos de asistencia no son válidos.";
  }
}
