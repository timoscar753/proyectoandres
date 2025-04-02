<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// ⚠️ Sustituye estos valores con los de Railway
$servername = "mysql.railway.internal"; // Host de Railway
$username = "root"; // Usuario de Railway
$password = "ybaPhZFnejzjGSkplnOZOPNfiAigNDUs"; // Contraseña de Railway
$database = "railway"; // Nombre de la base de datos en Railway
$port = "3306"; // Puerto de conexión en Railway

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $database, $port);

if ($conn->connect_error) {
    http_response_code(500);
    echo "Error de conexión: " . $conn->connect_error;
    exit();
}

// Verificar si el ID está presente
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    echo "Falta el parámetro ID o es inválido";
    exit();
}

$id = intval($_GET['id']);

// Preparar consulta
$stmt = $conn->prepare("SELECT pista FROM niveles WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Si hay resultados
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    foreach ($row as $key => $value) {
        echo "$value ";
    }
} else {
    http_response_code(404);
    echo "No se encontraron datos para el ID: $id";
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
