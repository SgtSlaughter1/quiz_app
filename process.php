<?php
// Start or resume the session
session_start();

// Check if user selected an answer
if (isset($_POST['answer'])) {
    // Save the user's answer
    $question_number = $_SESSION['current_question'];
    $_SESSION['answers'][$question_number] = $_POST['answer'];
    
    // Move to next question
    $_SESSION['current_question'] = $question_number + 1;
    
    // If we've answered all 5 questions
    if ($_SESSION['current_question'] > 5) {
        // Go to results page
        header('Location: result.php');
        exit();
    } else {
        // Go back to quiz page for next question
        header('Location: index.php');
        exit();
    }
}

// If something went wrong, go back to quiz
header('Location: index.php');
exit();
