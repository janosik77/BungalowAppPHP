<?php
require_once __DIR__ . "/server.php";

function getAllBungalows(): array {
    global $server;

    $query = "SELECT * FROM bungalow";
    $result = mysqli_query($server, $query)
        or exit("Unable to execute query");

    $bungalows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $bungalows[] = $row; 
    }
    
    return $bungalows;
}

// Wysyłanie danych jako JSON
header('Content-Type: application/json');
echo json_encode(getAllBungalows());
