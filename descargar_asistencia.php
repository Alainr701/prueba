<?php
require_once 'servicios/db.php';
//materia / id_docente 
if (isset($_GET['fecha']) && isset($_GET['materia']) && isset($_GET['id_docente'])) {
    $fecha = $_GET['fecha'];
    $materia = $_GET['materia'];
    $idDocente = $_GET['id_docente'];
    echo $fecha . "xxx<br>";
    echo $idDocente . "xxx<br>";
    echo $materia . "xxx<br>";
    // OBTERNER ID MATERIA SEGUN EL NOMBRE
    $query = "SELECT id_materia FROM materia WHERE nombre = '$materia'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc(); //ELFETCH ASSOC DEVUELVE UN ARRAY ASOCIATIVO
    $idMateria = $row['id_materia'];
    echo $idMateria . "xxx<br>";


    $query = "SELECT id_asistencia, id_estudiante, id_materia, fecha, asistencia, id_docente FROM asistencia WHERE id_docente = '$idDocente' AND id_materia = '$idMateria' AND fecha = '$fecha'";
    // $query = "SELECT id_asistencia, id_estudiante, id_materia, fecha, asistencia, id_docente FROM asistencia WHERE id_docente = '$idDocente' AND fecha = '$fecha'";
    $result = $conn->query($query);

    $asistencias = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $asistencia = array(
                'id_asistencia' => $row['id_asistencia'],
                'id_estudiante' => $row['id_estudiante'],
                'id_materia' => $row['id_materia'],
                'fecha' => $row['fecha'],
                'asistencia' => $row['asistencia'],
                'id_docente' => $row['id_docente']
            );

            $asistencias[] = $asistencia;
        }
    }

    // Imprimir la longitud del array de asistencias
    echo "Longitud del array de asistencias: " . count($asistencias) . "<br>";
    echo "asistencias: <br>";
    // Imprimir el array de asistencias
    foreach ($asistencias as $asistencia) {
        $id_asistencia = $asistencia['id_asistencia'];
        $id_estudiante = $asistencia['id_estudiante'];
        $id_materia = $asistencia['id_materia'];
        $fecha = $asistencia['fecha'];
        $asistencia_valor = $asistencia['asistencia']; // Cambio de nombre
        $id_docente = $asistencia['id_docente'];

        // Hacer lo que necesites con los datos de la asistencia
        echo "ID Asistencia: " . $id_asistencia . "<br>";
        echo "ID Estudiante: " . $id_estudiante . "<br>";
        echo "ID Materia: " . $id_materia . "<br>";
        echo "Fecha: " . $fecha . "<br>";
        echo "Asistencia: " . $asistencia_valor . "<br>"; // Uso del nuevo nombre
        echo "ID Docente: " . $id_docente . "<br>";
        echo "<br>";
    }
}
