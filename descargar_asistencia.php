<?php
require 'servicios/db.php';
require 'src/generar-excel.php';
//materia / id_docente 
if (isset($_GET['fecha']) && isset($_GET['materia']) && isset($_GET['id_docente'])) {
    $fecha = $_GET['fecha'];
    $materia = $_GET['materia'];
    $idDocente = $_GET['id_docente'];
    $query = "SELECT id_materia FROM materia WHERE nombre = '$materia'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc(); 
    $idMateria = $row['id_materia'];


    $query = "SELECT id_asistencia, id_estudiante, id_materia, fecha, asistencia, id_docente FROM asistencia WHERE id_docente = '$idDocente' AND id_materia = '$idMateria' AND fecha = '$fecha'";
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

    $data = array();

    foreach ($asistencias as $asistencia) {
        $id_asistencia = $asistencia['id_asistencia'];
        $id_estudiante = $asistencia['id_estudiante'];
        $id_materia = $asistencia['id_materia'];
        $fecha = $asistencia['fecha'];
        $asistencia_valor = $asistencia['asistencia'];
        $id_docente = $asistencia['id_docente'];

        // Obtener datos del estudiante
        $query = "SELECT apellido_paterno, apellido_materno, nombres, ci FROM estudiantes WHERE id_estudiante = '$id_estudiante'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $apellido_paterno = $row['apellido_paterno'];
        $apellido_materno = $row['apellido_materno'];
        $nombres = $row['nombres'];
        $ci = $row['ci'];

        $data[] = array(
            $id_estudiante,
            $apellido_materno . " " . $apellido_paterno . " " . $nombres,
            $ci,
            " ",
            $asistencia_valor
        );
    }
   
    crear_excel($data);
}
    