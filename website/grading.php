<?php
session_start();

require_once 'connection.php';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
// Check if session is set for 'age'
if (!isset($_SESSION['age'])) {
    echo "Error: Age session variable not set.";
    exit;
}

// Retrieve the quiz type from the session variable
$quizType = $_SESSION['age'];

// Define answer banks for each quiz type
$answerBanks = [
    'Early Elementary' => [
        'q1' => 'C', // Correct answers for Early Elementary
        'q2' => 'C',
        'q3' => 'B',
        'q4' => 'A',
        'q5' => 'D'
    ],
    'Upper Elementary' => [
        'q1' => 'A', // Correct answers for Upper Elementary
        'q2' => 'C',
        'q3' => 'B',
        'q4' => 'B',
        'q5' => 'C',
        'q6' => 'B',
        'q7' => 'C',
        'q8' => 'B'
    ],
    'Middle School' => [
        'q1' => 'A', // Correct answers for Middle School
        'q2' => 'B',
        'q3' => 'A',
        'q4' => 'C',
        'q5' => 'A',
        'q6' => 'B',
        'q7' => 'B'
    ]
];

// Check if the quiz type exists in the session
if (!array_key_exists($quizType, $answerBanks)) {
    echo "Error: Invalid quiz type.";
    exit;
}

// Get the answer bank for the current quiz
$answers = $answerBanks[$quizType];

// User's answers (coming from the form)
$userAnswers = [];
foreach ($answers as $key => $value) {
    if (isset($_POST[$key])) {
        $userAnswers[$key] = $_POST[$key];
    }
}

// Calculate the score
$score = 0;
foreach ($answers as $key => $value) {
    if (isset($userAnswers[$key]) && $userAnswers[$key] == $value) {
        $score++;
    }
}

// Calculate total number of questions for the current quiz
$totalQuestions = count($answers);

// Calculate the percentage score
$percentage = ($score / $totalQuestions) * 100;

// Grade the score based on the percentage
if ($percentage >= 90) {
    $grade = 'A';
} elseif ($percentage >= 80) {
    $grade = 'B';
} elseif ($percentage >= 70) {
    $grade = 'C';
} elseif ($percentage >= 60) {
    $grade = 'D';
} else {
    $grade = 'F';
}

// SQL query with placeholders
$sql = "UPDATE users SET grade = ? WHERE username = ?";
// Prepare the statement
$stmt = $pdo->prepare($sql);


// Bind and execute the statement
$stmt->execute([$grade, $username]);

$_SESSION['grade'] = $grade;

// Redirect to certificate.php
header("Location: certificate.php");
exit; // Ensure no further code is executed after the redirect
?>
