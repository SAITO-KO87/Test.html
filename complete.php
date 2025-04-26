<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['index'])) {
    $tasks = file_exists('tasks.json') ? json_decode(file_get_contents('tasks.json'), true) : [];
    $index = (int)$_POST['index'];
    if (isset($tasks[$index])) {
        $tasks[$index]['completed'] = !$tasks[$index]['completed'];
        file_put_contents('tasks.json', json_encode($tasks, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
header('Location: index.php');
exit;
