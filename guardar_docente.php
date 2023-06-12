<?php
require_once 'servicios/db.php';

// Obtener los valores desde el formulario o donde los tengas almacenados
$nombre = $_POST['nombres'];
$apellido = $_POST['apellidos'];
$correoElectronico = $_POST['email'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];

// Construir la consulta de inserción
$sql = "INSERT INTO docentes (nombres, apellidos, correo_electronico, usuario, contrasena) VALUES ('$nombre', '$apellido', '$correoElectronico', '$usuario', '$contrasena')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Registro insertado correctamente";
} else {
    echo "Error al insertar el registro: " .  $conn->error;
}
if (isset($_POST['materia'])) {
    $materiasSeleccionadas = $_POST['materia'];
    // Insertar el docente en la tabla docentes
    $sql = "INSERT INTO docentes (nombres, apellidos, correo_electronico, usuario, contrasena) VALUES ('$nombre', '$apellido', '$correoElectronico', '$usuario', '$contrasena')";

    if ($conn->query($sql) === TRUE) {
        $idDocente = $conn->insert_id;
        // Iterar sobre las materias seleccionadas y crear las relaciones en la tabla docente_materia
        foreach ($materiasSeleccionadas as $idMateria) {
            $sqlRelacion = "INSERT INTO docente_materia (id_docente, id_materia) VALUES ($idDocente, $idMateria)";
            if ($conn->query($sqlRelacion) === TRUE) {
                echo "Relación docente-materia insertada correctamente";
                $_SESSION['id_docente'] = $idDocente;
                setcookie("logged_in", true, time() + 3600, "/");
                header("Location: index.php");
            } else {
                echo "Error al insertar la relación docente-materia: " . $conn->error;
            }
        }
    } else {
        echo "Error al insertar el registro: " . $conn->error;
    }
}
