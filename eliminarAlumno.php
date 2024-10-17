<?php
include 'conexion.php';

if (
    isset($_POST['matricula'])
    ){
    $matricula = $_POST['matricula'];

    $stmt = $conn->prepare("DELETE FROM alumno WHERE matricula = $matricula;");
    if ($stmt === false) {
        die('Error en la preparación de la consulta SQL: ' . htmlspecialchars($conn->error));
    }

    if ($stmt->execute()) {
        header("Location:../verAlumno2.php");
        exit();
    } else {
        echo '<script>
            alert("Alumno no elimina, inténtalo nuevamente");
            window.location.href = "../eliminarAlumno.php";
            </script>' . htmlspecialchars($stmt->error);
    }

    $stmt->close();
} else {
    echo "Por favor, complete el campos.";
}

?>
// Como sasdaasd
