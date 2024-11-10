<?php
//CORS policy fixing. Security measures for web API stuff
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-with");
header("Content-Type: application/json; charset=UTF-8");

require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    //Respond 200 to PreFlight
    http_response_code(200);
    exit();
};
//Set up main condition
if($_SERVER["REQUEST_METHOD"] === 'POST'){
    //Okay so SPLINE sends data as one massive string not a JSON so we need to manually turn it into an array, I can force this into an associative but for not an index one will work
    $dataSentPOST = file_get_contents('php://input');
    $data = explode(",",$dataSentPOST);

    // Require connection to the database file
    require_once 'connection.php';

    //Set variables
    $username = $data[0];  
    $age = $data[1];  
    $positionString = $data[2];

    if ($positionString == 'boneMarrow') {
        $stmt = $pdo->prepare("UPDATE users SET position = 'boneMarrow' WHERE username = ?");
        $stmt->execute([$username]);
    } elseif ($positionString == 'halfHeart') {
        $stmt = $pdo->prepare("UPDATE users SET position = 'halfHeart' WHERE username = ?");
        $stmt->execute([$username]);
    } elseif ($positionString == 'lungs') {
        $stmt = $pdo->prepare("UPDATE users SET position = 'lungs' WHERE username = ?");
        $stmt->execute([$username]);
    } elseif ($positionString == 'brain') {
        $stmt = $pdo->prepare("UPDATE users SET position = 'brain' WHERE username = ?");
        $stmt->execute([$username]);
    } elseif ($positionString == 'liver') {
        $stmt = $pdo->prepare("UPDATE users SET position = 'liver' WHERE username = ?");
        $stmt->execute([$username]);
    } elseif ($positionString == 'kidney') {
        $stmt = $pdo->prepare("UPDATE users SET position = 'kidneys' WHERE username = ?");
        $stmt->execute([$username]);
    } elseif ($positionString == 'digestive') {
        $stmt = $pdo->prepare("UPDATE users SET position = 'digestive' WHERE username = ?");
        $stmt->execute([$username]);
    } elseif ($positionString == 'fullheart') {
        $stmt = $pdo->prepare("UPDATE users SET position = 'fullheart' WHERE username = ?");
        $stmt->execute([$username]);
    } elseif ($positionString == 'corner1') {
        $stmt = $pdo->prepare("UPDATE users SET position = 'corner1' WHERE username = ?");
        $stmt->execute([$username]);
    }  elseif ($positionString == 'corner2') {
        $stmt = $pdo->prepare("UPDATE users SET position = 'corner2' WHERE username = ?");
        $stmt->execute([$username]);
    } elseif ($positionString == 'corner3') {
            $stmt = $pdo->prepare("UPDATE users SET position = 'corner3' WHERE username = ?");
            $stmt->execute([$username]);
    } elseif ($positionString == 'quiz') {
            $stmt = $pdo->prepare("UPDATE users SET position = 'quiz' WHERE username = ?");
            $stmt->execute([$username]);
    } else {
        $response = [
                "messege" => "Something Went Wrong",
                "username" => $username,
                "age" => $age,
                "position" => $positionString,
                "data" => $data
            ];
        echo json_encode($response);
    }

}
?>