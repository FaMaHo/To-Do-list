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
        <div class="container">
            <h2>Todo List</h2>
            <div class="messageBox">
                <input required placeholder="Add task..." type="text" id="messageInput">
                <button id="sendButton">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 664 663">
                        <path
                            fill="none"
                            d="M646.293 331.888L17.7538 17.6187L155.245 331.888M646.293 331.888L17.753 646.157L155.245 331.888M646.293 331.888L318.735 330.228L155.245 331.888"
                        ></path>
                        <path
                            stroke-linejoin="round"
                            stroke-linecap="round"
                            stroke-width="33.67"
                            stroke="#6c6c6c"
                            d="M646.293 331.888L17.7538 17.6187L155.245 331.888M646.293 331.888L17.753 646.157L155.245 331.888M646.293 331.888L318.735 330.228L155.245 331.888"
                        ></path>
                    </svg>
                </button>
            </div>
            <ul id="taskList"></ul>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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

        function saveTasks() {
            const tasks = [];
            document.querySelectorAll('.task-item').forEach(taskItem => {
                tasks.push({
                    text: taskItem.querySelector('.task-text').textContent,
                    completed: taskItem.querySelector('input[type="checkbox"]').checked
                });
            });
            localStorage.setItem('tasks', JSON.stringify(tasks));
        }

        function loadTasks() {
            const tasks = JSON.parse(localStorage.getItem('tasks')) || [];
            tasks.forEach(task => addTask(task.text, task.completed));
        }

        function addTask(taskText = "", completed = false) {
            const taskInput = document.getElementById("messageInput");
            const taskList = document.getElementById("taskList");
            const task = taskText || taskInput.value.trim();

            if (task !== "") {
                const li = document.createElement("li");
                li.className = "task-item";

                const checkbox = document.createElement("input");
                checkbox.type = "checkbox";
                checkbox.checked = completed;
                checkbox.onclick = function() {
                    li.style.textDecoration = this.checked ? "line-through" : "none";
                    saveTasks();
                };

                const taskSpan = document.createElement("span");
                taskSpan.textContent = task;
                taskSpan.contentEditable = "true";
                taskSpan.className = "task-text";
                taskSpan.oninput = saveTasks;

                const deleteButton = document.createElement("button");
                deleteButton.className = "deleteButton";
                deleteButton.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 50 59" class="bin">
                        <path fill="#B5BAC1" d="M0 7.5C0 5.01472 2.01472 3 4.5 3H45.5C47.9853 3 50 5.01472 50 7.5V7.5C50 8.32843 49.3284 9 48.5 9H1.5C0.671571 9 0 8.32843 0 7.5V7.5Z"></path>
                        <path fill="#B5BAC1" d="M17 3C17 1.34315 18.3431 0 20 0H29.3125C30.9694 0 32.3125 1.34315 32.3125 3V3H17V3Z"></path>
                        <path fill="#B5BAC1" d="M2.18565 18.0974C2.08466 15.821 3.903 13.9202 6.18172 13.9202H43.8189C46.0976 13.9202 47.916 15.821 47.815 18.0975L46.1699 55.1775C46.0751 57.3155 44.314 59.0002 42.1739 59.0002H7.8268C5.68661 59.0002 3.92559 57.3155 3.83073 55.1775L2.18565 18.0974ZM18.0003 49.5402C16.6196 49.5402 15.5003 48.4209 15.5003 47.0402V24.9602C15.5003 23.5795 16.6196 22.4602 18.0003 22.4602C19.381 22.4602 20.5003 23.5795 20.5003 24.9602V47.0402C20.5003 48.4209 19.381 49.5402 18.0003 49.5402ZM29.5003 47.0402C29.5003 48.4209 30.6196 49.5402 32.0003 49.5402C33.381 49.5402 34.5003 48.4209 34.5003 47.0402V24.9602C34.5003 23.5795 33.381 22.4602 32.0003 22.4602C30.6196 22.4602 29.5003 23.5795 29.5003 24.9602V47.0402Z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        <path fill="#B5BAC1" d="M2 13H48L47.6742 21.28H2.32031L2 13Z"></path>
                    </svg>
                    <span class="tooltip">Delete</span>
                `;
                deleteButton.onclick = function() {
                    li.remove();
                    saveTasks();
                };

                li.appendChild(checkbox);
                li.appendChild(taskSpan);
                li.appendChild(deleteButton);
                taskList.appendChild(li);
                taskInput.value = "";
                saveTasks();
            }
        }

        document.getElementById("sendButton").onclick = function(event) {
            event.preventDefault();
            addTask();
        };

        document.getElementById("messageInput").addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                addTask();
            }
        });

        window.onload = loadTasks;
    </script>
</body>
</html>
