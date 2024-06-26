<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $comment = htmlspecialchars(trim($_POST['comment']));

    if (!empty($name) && !empty($email) && !empty($comment) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        echo "Your question has been submitted successfully.";
    } else {
        echo "There was an error submitting your question. Please ensure all fields are filled out correctly.";
    }
} else {
    echo "Invalid request method.";
}
?>
