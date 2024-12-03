<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Residencias_Tesji";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallia: " . $conn->connect_error);
}
?>
