<?php
session_start();

// Check if restart button was clicked
if (isset($_POST['restart'])) {
    session_destroy();
    header('Location: index.php');
    exit();
}

// Check if user completed the quiz
if (!isset($_SESSION['answers']) || count($_SESSION['answers']) < 5) {
    header('Location: index.php');
    exit();
}

// Questions array (only need correct answers for scoring)
$correct_answers = [
    1 => "A",  // Paris
    2 => "B",  // Mars
    3 => "C",  // 4
    4 => "B",  // Programming Language
    5 => "A"   // Hyper Text Markup Language
];

// Calculate score
$score = 0;
foreach ($_SESSION['answers'] as $question_num => $answer) {
    if ($answer === $correct_answers[$question_num]) {
        $score++;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Quiz Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        .score {
            font-size: 24px;
            margin: 20px;
        }
        .restart-btn {
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="score">
        Your Score: <?php echo $score; ?> out of 5
    </div>
    
    <form method="POST">
        <button type="submit" name="restart" class="restart-btn">Restart Quiz</button>
    </form>
</body>
</html> 