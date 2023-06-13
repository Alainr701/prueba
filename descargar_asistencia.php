<?php
require 'servicios/db.php';
require 'src/generar-excel.php';
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
    
        // Construir el arreglo de datos
        $data[] = array(
            $id_estudiante,
            $apellido_materno." ".$apellido_paterno." ".$nombres,
            $ci,
            " ",
            // $id_asistencia,
            // $id_materia,
            // $fecha,
            $asistencia_valor
        );
    }
    // Imprimir el arreglo de datos
    foreach ($data as $row) {
        echo "[" . implode(", ", $row) . "]<br>";
    } 
    //PONER $data dentro de un array
     echo "data: <br>";
    $data = [
        [2,"PEREZ PEREZ JUAN",12345," ","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","5","10","11","21"," ",2,2,3,3,2,3,4,3,4,5,3,2,4,39,65,"#",75," ","APROBADO"],
        [2,"PEREZ PEREZ JUAN",12345," ","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","5","10","11","21"," ",2,2,3,3,2,3,4,3,4,5,3,2,4,39,65,"#",75," ","APROBADO"],
    ];
    crear_excel($data);
}