<?php
include 'conexion.php';

if (isset($_POST['usuario']) && isset($_POST['nombre']) && isset($_POST['contraseña'])) {
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $contraseña = $_POST['contraseña'];

    $stmt = $conn->prepare("INSERT Usuario VALUES (?, ?, ?, 2)");

    if ($stmt === false) {
        die('Error en la preparación de la consulta SQL: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("sss", $usuario, $nombre, MD5($contraseña));

    if ($stmt->execute()) {
        header("Location: ../ingresar.php");
        exit();
    } else {
        echo '<script>
            alert("El usuario ya existe, verifica bien tus datos:");
            window.location.href = "../registrar.php";
            </script>' . htmlspecialchars($stmt->error);
    }

    $stmt->close();
} else {
    echo "Por favor, complete todos los campos.";
}

$conn->close();
?>