<?php
include 'conexion.php';

if (isset($_POST['matricula']) && isset($_POST['contraseña'])) {
    $usuario = $_POST['matricula'];
    $contraseña = $_POST['contraseña'];

    $stmt = $conn->prepare("SELECT matricula, contrasenia FROM Usuario WHERE matricula = ? AND contrasenia = MD5(?) AND rol=2");
    $stmt2 = $conn->prepare("SELECT matricula, contrasenia FROM Usuario WHERE matricula = ? AND contrasenia = MD5(?) AND rol=1");

    if ($stmt === false) {
        die('Error en la preparación de la consulta SQL: ' . htmlspecialchars($conn->error));
    }
    if ($stmt2 === false) {
        die('Error en la preparación de la consulta SQL: ' . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ss", $usuario, $contraseña);
    $stmt2->bind_param("ss", $usuario, $contraseña);

    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {    
        session_start();
        $_SESSION['clave'] = $_REQUEST['matricula'];
            header("Location: ../form-alumno.php");
            exit();
        }elseif ($stmt2->execute()){
            $result2 = $stmt2->get_result();
            if ($result2->num_rows > 0) {    
                session_start();
                $_SESSION['clave'] = $_REQUEST['matricula'];
                    header("Location: ../verAlumno2.php");
                    exit();
                }else{
                    echo '<script>
                    alert("Usuario o contraseña Incorrecta");
                    window.location.href = "../ingresar.php";
                    </script>';
                }
    
        }else{
            echo '<script>
            alert("Usuario o contraseña Incorrecta");
            window.location.href = "../ingresar.php";
            </script>';
        }
    }else{
        
        echo "Error al ejecutar la consulta: " . htmlspecialchars($stmt->error);
    }

    
} else {
    echo "Por favor, complete ambos campos.";
}


?>

