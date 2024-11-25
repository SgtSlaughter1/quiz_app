<?php
// Start a new or resume existing session
session_start();

// Create our quiz questions
// Each question has: the question text, answer choices, and the correct answer
$questions = [
    1 => [
        "question" => "What is the capital of France?",
        "options" => [
            "A" => "Paris",
            "B" => "London",
            "C" => "Rome",
            "D" => "Berlin"
        ],
        "correct" => "A"
    ],
    2 => [
        "question" => "Which planet is known as the Red Planet?",
        "options" => [
            "A" => "Venus",
            "B" => "Mars",
            "C" => "Jupiter",
            "D" => "Saturn"
        ],
        "correct" => "B"
    ],
    3 => [
        "question" => "What is 2 + 2?",
        "options" => [
            "A" => "3",
            "B" => "5",
            "C" => "4",
            "D" => "6"
        ],
        "correct" => "C"
    ],
    4 => [
        "question" => "Which language is PHP?",
        "options" => [
            "A" => "Markup Language",
            "B" => "Programming Language",
            "C" => "Query Language",
            "D" => "Styling Language"
        ],
        "correct" => "B"
    ],
    5 => [
        "question" => "What does HTML stand for?",
        "options" => [
            "A" => "Hyper Text Markup Language",
            "B" => "High Tech Modern Language",
            "C" => "Hyper Transfer Markup Language",
            "D" => "Home Tool Markup Language"
        ],
        "correct" => "A"
    ]
];

// If this is the first time loading the page
if (!isset($_SESSION['current_question'])) {
    // Start with question 1
    $_SESSION['current_question'] = 1;
    // Create empty array to store user's answers
    $_SESSION['answers'] = [];
}

// Check if we've gone past the last question
if ($_SESSION['current_question'] > 5) {
    // Redirect to results page
    header('Location: result.php');
    exit();
}

// Get current question data
$current_question_number = $_SESSION['current_question'];
$current_question = $questions[$current_question_number];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            width: 80%;
            margin: 20px auto;
            padding: 20px;
        }
        .question {
            padding: 20px;
            margin-bottom: 20px;
        }
        .options {
            margin-left: 20px;
        }
        .options div {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>Simple Quiz</h1>

    <!-- Show the current question -->
    <div class="question">
        <h3>Question <?php echo $current_question_number; ?></h3>
        <p><?php echo $current_question['question']; ?></p>
        
        <!-- Form to submit the answer -->
        <form method="POST" action="process.php">
            <div class="options">
                <?php foreach ($current_question['options'] as $key => $option) : ?>
                    <div>
                        <input type="radio" name="answer" value="<?php echo $key; ?>" id="option_<?php echo $key; ?>" required>
                        <label for="option_<?php echo $key; ?>"><?php echo $option; ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <button type="submit">Next Question</button>
        </form>
    </div>
</body>
</html>
