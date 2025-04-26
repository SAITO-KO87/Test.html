<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['task']) && !empty($_POST['due_date'])) {
    $task = trim($_POST['task']);
    $dueDate = $_POST['due_date'];

    $tasks = file_exists('tasks.json') ? json_decode(file_get_contents('tasks.json'), true) : [];
    $tasks[] = [
        'name' => $task,
        'completed' => false,
        'due_date' => $dueDate
    ];
    file_put_contents('tasks.json', json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}
header('Location: index.php');
exit;
