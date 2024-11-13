<?php
// Start the session to access session variables
session_start();

// Get the session variables
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$score = isset($_SESSION['grade']) ? $_SESSION['grade'] : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Certification Page</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    
    body, html {
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: Arial, sans-serif;
    }

    .container {
      display: flex;
      width: 80%;
      height: 80vh;
      border-radius: 8px;
    }

    .image-container {
      flex: 8;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .image-container img {
      width: 100%;
      height: auto;
      object-fit: contain;
    }

    .button-container {
      flex: 2;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
    }

    .score-text {
      margin-bottom: 20px;
      font-size: 1.2em;
      color: #333;
    }

    .button-container a {
      padding: 12px 24px;
      background-color: #4CAF50;
      color: white;
      text-decoration: none;
      font-size: 1.2em;
      border-radius: 5px;
      text-align: center;
      transition: background-color 0.3s ease;
    }

    .button-container a:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="image-container">
      <img src="certificate.jpg" alt="Certification Image">
    </div>
    <div class="button-container">
      <div class="score-text">
        <?php echo htmlspecialchars($username); ?>'s score is <?php echo htmlspecialchars($score); ?>
      </div>
      <a href="https://cellularodyssey.jonathanwebworks.com/index.html">Play Again?</a>
    </div>
  </div>
</body>
</html>
<!- this is a comment -->

