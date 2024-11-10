<?php
//CORS policy fixing. Security measures for web API stuff
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-with");
header("Content-Type: application/json; charset=UTF-8");

//Start Session to access username for database purposes
session_start();

//Establish Connection with DB
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    //Respond 200 to PreFlight
    http_response_code(200);
    exit();
};


//Set up main condition
if($_SERVER["REQUEST_METHOD"] === 'GET'){
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    $age = isset($_SESSION['age']) ? $_SESSION['age'] : '';
    
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    $age = isset($_SESSION['age']) ? $_SESSION['age'] : '';
    
    $stmt = $pdo->prepare("SELECT position FROM users WHERE username = ?");
    
    // Execute the statement with the username as the parameter
    $stmt->execute([$username]);
    
    // Fetch the data as an associative array
    $data = $stmt->fetch();
    
    
    if ($data) {
        $position = $data['position'];
        //Set up condition chain for age groups to determine what text they need
        if ($age == "Early Elementary") {
            if ($position == 'beggining') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageOne WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'boneMarrow') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageOne WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'halfHeart') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageOne WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'lungs') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageOne WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'brain') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageOne WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'liver') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageOne WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'kidneys') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageOne WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'digestive') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageOne WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'fullheart') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageOne WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'corner1') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageOne WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'corner2') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageOne WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'corner3') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageOne WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'quiz') {
                $displaytxt = "quizTime";
            }
            
            if ($displaytxt || $display == "quizTime") {
                // Create an array to send through JSON
                $response = [
                    'position' => $position,
                    'displaytxt' => $displaytxt
                ];
            
                // Encode the array as JSON and send the response
                echo json_encode($response);
                exit;
            }
            else{
                $response = [
                'displaytxt' => "Outside of any condition in Early elementary",
                ];
                // Encode the array as JSON and send the response
                echo json_encode($response);
                exit;
            }
                
        //Age Two Condition Chain
        } elseif ($age == "Upper Elementary") {
            if ($position == 'boneMarrow') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageTwo WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'halfHeart') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageTwo WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'lungs') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageTwo WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'brain') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageTwo WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'liver') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageTwo WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'kidneys') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageTwo WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'digestive') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageTwo WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'fullheart') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageTwo WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'corner1') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageTwo WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'corner2') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageTwo WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'corner3') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageTwo WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'quiz') {
                $displaytxt = "quizTime";
            }
            
            
           if ($displaytxt || $display == "quizTime") {
                // Create an array to send through JSON
                $response = [
                    'position' => $position,
                    'displaytxt' => $displaytxt
                ];
            
                // Encode the array as JSON and send the response
                echo json_encode($response);
                exit;
            }
            
        
        //Condition Chain for age 11 - 13
        } elseif ($age == "Middle School") {
            if ($position == 'boneMarrow') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageThree WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'halfHeart') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageThree WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'lungs') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageThree WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'brain') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageThree WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'liver') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageThree WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'kidneys') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageThree WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'digestive') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageThree WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'fullheart') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageThree WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'corner1') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageThree WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'corner2') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageThree WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'corner3') {
                $stmt = $pdo->prepare("SELECT displaytxt FROM ageThree WHERE position = ?");
                $stmt->execute([$position]);
                $displaytxt = $stmt->fetchColumn();
            } elseif ($position == 'quiz') {
                $displaytxt = "quizTime";
            }
            
            
            if ($displaytxt || $display == "quizTime") {
                // Create an array to send through JSON
                $response = [
                    'position' => $position,
                    'displaytxt' => $displaytxt
                ];
            
                // Encode the array as JSON and send the response
                echo json_encode($response);
                exit;
            }

            
        } else {
            $response = [
                'error' => "Outside of any condition",
            ];
            // Encode the array as JSON and send the response
            echo json_encode($response);
            exit;
        }
        }  
    } else {
         $response = [
            "error" => "something went wrong"
            ];
         echo json_encode($response);
        exit;
    }
?>