<?php 
$servername = "localhost";  // Servidor MySQL
$username = "root";  // Usuario de MySQL
$password = "";  // Contraseña (por defecto en XAMPP es "")
$database = "juego";  // Nombre de la base de datos

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verifica si hay errores en la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener el ID de la URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Consulta SQL
    $sql = "SELECT * FROM niveles WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar los datos sin formato, solo los valores
        $row = $result->fetch_assoc();
        foreach ($row as $campo => $valor) {
            echo "$campo: $valor\n";
        }
    } else {
        echo "No se encontraron datos";
    }
} else {
    echo "Falta el parámetro ID";
}

$conn->close();
?>
