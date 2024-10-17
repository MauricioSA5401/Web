<?php
include 'conexion.php';

if (
    isset($_POST['matricula']) &&
    isset($_POST['nombre']) &&
    isset($_POST['apellido1']) &&
    isset($_POST['apellido2']) &&
    isset($_POST['telefono1']) &&
    isset($_POST['correo']) &&
    isset($_POST['direccion']) &&
    isset($_POST['ciudad']) &&
    isset($_POST['telefono2']) &&
    isset($_POST['carrera']) &&
    isset($_POST['semestre'])
    ){
    $matricula = $_POST['matricula'];
    $nombre = $_POST['nombre'];
    $ape1 = $_POST['apellido1'];
    $ape2 = $_POST['apellido2'];
    $tel1 = $_POST['telefono1'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $tel2 = $_POST['telefono2'];
    $carrera = $_POST['carrera'];
    $semestre = $_POST['semestre'];

    $stmt = $conn->prepare("UPDATE Alumno SET nombre = ?, ape1 = ?, ape2 = ?, telefono = ?, correo = ?, direccion = ?, ciudad = ?, telefonoP = ?, carrera = ?, semestre = ?, usuario = ? WHERE matricula = $matricula;");
    if ($stmt === false) {
        die('Error en la preparación de la consulta SQL: ' . htmlspecialchars($conn->error));
    }
    
    $stmt->bind_param("sssssssssss", $nombre, $ape1, $ape2, $tel1, $correo, $direccion, $ciudad, $tel2, $carrera, $semestre, $matricula);

    if ($stmt->execute()) {
        session_start();
        $_SESSION['matricula'] = $_REQUEST['matricula'];
        $_SESSION['nombre'] = $_REQUEST['nombre'];
        $_SESSION['ape1'] = $_REQUEST['apellido1'];
        $_SESSION['ape2'] = $_REQUEST['apellido2'];

        header("Location:../verAlumno2.php");
        exit();
    } else {
        echo '<script>
            alert("Datos no guardados, inténtalo nuevamente");
            window.location.href = "../modificarAlumno.php";
            </script>' . htmlspecialchars($stmt->error);
    }

    $stmt->close();
} else {
    echo "Por favor, complete todos los campos.";
}

?>