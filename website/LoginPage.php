<?php
//Start The Session
session_start();

//Require Connection to database file 
require_once 'connection.php';

//Check if the form was submitted to the server
if($_POST['submitbutton'] == "pressed"){
    //Set up the username based on what the POST global array has and if there isnt anything make it a blank string
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $age = isset($_POST['age_group']) ? $_POST['age_group'] : '';
    $score =  0;

    // Prepare the SQL query to check if the username exists using a positional placeholder
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    // Execute the query, passing the username as an argument to bind to the placeholder
    $stmt->execute([$username]);
    
    // Fetch the count result
    $count = $stmt->fetchColumn();
    
    // Check if the count is greater than 0 (username exists)
    if ($count > 0) {
        //Grab All the info I need from this bullshit
       //Check to see if the username exists
        $attempt_logIN = $pdo->prepare("SELECT username, age, grade FROM  users WHERE username = ?");
        $attempt_logIN->execute([$username]);
        //Check to see if there was a return from the database 
        $data = $attempt_logIN->fetch();
        
        if($age != $data['age']){
            $updateQuery = $pdo->prepare("UPDATE users SET age = ? WHERE username = ?");
            // Execute the query with the new age and username values
            $updateQuery->execute([$age, $username]);
            //Set the score variable dynamically here 
            // Re-fetch data after updating age
            $attempt_logIN->execute([$username]); // re-execute the query
            $data = $attempt_logIN->fetch(); // fetch the updated data
            $ageDB = $data['age'];
        }
        else{
             $ageDB = $data['age'];
        }
        //set variables from DB
        $usernameDB = $data['username'];
        $scoreDB = $data['grade'];
        
        //Set Session variable
        $_SESSION['username'] = $usernameDB;
        $_SESSION['age'] = $ageDB;
        $_SESSION['score'] = $scoreDB;
        
        //Build Out URL|
        // Base URL
        $baseUrl = "https://cellularodyssey.jonathanwebworks.com/homepage.html";
        
        // Build the URL with query parameters
        $url = $baseUrl . '?' . http_build_query([
            'username' => $usernameDB,
            'age' => $ageDB,
            'score' => $scoreDB,
        ]);
        header("Location: " . $url);
        exit;
            
            
    } else {
        //Set Score to "none"
        $score = "none";
        //Insert new data into the database
        $insertQuery = $pdo->prepare("INSERT INTO users (username, age, grade) VALUES (?, ?, ?)");
        // Execute the query with the values for username, age, and score
        $insertQuery->execute([$username, $age, $score]);
        
        $usernameDB = $_POST['username'];
        $ageDB = $_POST['age_group'];
        $scoreDB = $score;
        
        //Set Session variable
        $_SESSION['username'] = $usernameDB;
        $_SESSION['age'] = $ageDB;
        $_SESSION['score'] = $scoreDB;
        
        // Base URL
        $baseUrl = "https://cellularodyssey.jonathanwebworks.com/homepage.html";
        
        // Build the URL with query parameters
        $url = $baseUrl . '?' . http_build_query([
            'username' => $usernameDB,
            'age' => $ageDB,
            'score' => $score,
        ]);
            }
            
        header("Location: " . $url);
        exit;
}
?>
