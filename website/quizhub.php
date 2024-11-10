<?php
session_start();

// Check if 'age' session variable is set
if (isset($_SESSION['age'])) {
    $age = $_SESSION['age'];

    // Redirect based on age value
    if ($age == "Early Elementary") {
        header("Location: quizONE.html"); // Redirect to quizONE if age is less than 13
    } elseif ($age == "Upper Elementary") {
        header("Location: quizTWO.html"); // Redirect to quizTWO if age is between 13 and 18
    } else {
        header("Location: quizTHREE.html"); // Redirect to quizTHREE if age is over 18
    }
    exit();
} else {
    echo "Age is not set in the session.";
}
?>
