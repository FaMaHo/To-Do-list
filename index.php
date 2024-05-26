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
        <div class="row">
            <div class="col">
                <div class="task-planner">
                    <svg height="5" width="47">
                        <line x1="15" y1="0" x2="47" y2="0" style="stroke:#6F6E6E;stroke-width:1;"></line>
                    </svg>
                    <p id="small_gray">TASK PLANNER</p>
                </div>
                <p id="big_text">Organize<br>Your Task</p>
                <p style="margin: 0 0 0 2vw;">
                    Welcome to the Poli Planner Web App!<br>
                    This is your central hub for managing tasks,<br>
                    staying organized, and boosting productivity.
                </p>
                <button class="start-button" onclick="location.href='tasks.php'">
                    START PLANNING
                    <div class="arrow-wrapper">
                        <div class="arrow"></div>
                    </div>
                </button>
            </div>
            <div class="col">
                <img class="main-img" src="images_/imac--removebg-preview.png" alt="imac">
            </div>
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
    </script>
</body>
</html>
