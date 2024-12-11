<?php
$response = [
    'status' => 'success',
    'message' => 'Hello World!',
];

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo "GET request";
        break;
    case 'POST':
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "form";

        // Cria a conexão
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verifica a conexão
        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        } else {
            echo "Conexão realizada com sucesso!";
        }

        // Adiciona um novo cliente
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            // Debugging: Print the received form data
            echo "<pre>";
            print_r($_REQUEST);
            echo "</pre>";

            $name = $_POST['name'];
            $email = $_POST['email'];
            $age = $_POST['age'];

            $stmt = $conn->prepare("INSERT INTO form_test (name, email, age) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $age);
            $stmt->execute();
            $stmt->close();
            
        }
        break;
    case 'PUT':
        echo "PUT request";
        break;
    case 'DELETE':
        echo "DELETE request";
        break;
    default:
        echo "Unsupported request";
        break;
}
