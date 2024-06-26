<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PoliPlanner</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="icon" href="images_/icon.png" type="image/x-icon">
</head>
<body>
    <?php include 'header.php'; ?>
<main>
    <div class="help-container">
        <h2>Help and Support</h2>
        <section id="introduction">
            <h3>Introduction</h3>
            <p>Welcome to PoliPlanner! This guide will help you get the most out of our to-do list application.</p>
        </section>
        <section id="creating-tasks">
            <h3>Creating Tasks</h3>
            <p>To create a new task:</p>
            <ol>
                <li>Navigate to the dashboard.</li>
                <li>Click the "START PLANNING" button.</li>
                <li>Enter the task details</li>
                <li>Press enter or the send button to add the task to your list.</li>
            </ol>
        </section>
        <section id="managing-tasks">
            <h3>Managing Tasks</h3>
            <p>You can manage your tasks by:</p>
            <ul>
                <li><strong>Editing Tasks:</strong> Click on a task and make changes, then press enter.</li>
                <li><strong>Deleting Tasks:</strong> Click the delete icon next to a task to remove it.</li>
            </ul>
        </section>
        <section id="support">
            <h3>Support</h3>
            <p>If you need further assistance, you can write your question in the box below; our support team will answer you as soon as possible.</p>
        </section>
    </div>
    <div class="cardd">
        <span class="title">Ask your question</span>
        <form class="form" action="submit_question.php" method="post" onsubmit="return validateForm(event)">
            <div class="group-card">
                <input placeholder="‎" type="text" id="name" name="name" required>
                <label for="name">Name</label>
            </div>
            <div class="group-card">
                <input placeholder="‎" type="email" id="email" name="email" required>
                <label for="email">Email</label>
            </div>
            <div class="group-card">
                <textarea placeholder="‎" id="comment" name="comment" rows="5" required></textarea>
                <label for="comment">Comment</label>
            </div>
            <button type="submit">Submit</button>
        </form>
        <div id="notification" class="notification"></div>
    </div>
</main>
<?php include 'footer.php'; ?>
<script>
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const body = document.body;

    function setDarkModePreference(enabled) {
        localStorage.setItem('darkModeEnabled', enabled);
    }

    function applyDarkMode(enabled) {
        if (enabled) {
            body.classList.add('dark-mode');
            darkModeToggle.checked = true;
        } else {
            body.classList.remove('dark-mode');
            darkModeToggle.checked = false;
        }
    }

    darkModeToggle.addEventListener('change', () => {
        const darkModeEnabled = darkModeToggle.checked;
        setDarkModePreference(darkModeEnabled);
        applyDarkMode(darkModeEnabled);
    });

    window.addEventListener('load', () => {
        const darkModeEnabled = localStorage.getItem('darkModeEnabled') === 'true';
        applyDarkMode(darkModeEnabled);
    });

    function validateForm(event) {
        event.preventDefault();

        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const comment = document.getElementById('comment').value;
        const notification = document.getElementById('notification');

        if (name && email && comment) {
            notification.className = 'notification success';
            notification.textContent = 'Your question is submitted, and we will answer it through email.';
            notification.style.display = 'block';
            document.querySelector('.form').reset();
        } else {
            notification.className = 'notification error';
            notification.textContent = 'Please fill out all fields.';
            notification.style.display = 'block';
        }
    }
</script>
</body>
</html>
