<?php
// タスク保存用ファイル
$filename = 'tasks.txt';

// POST送信されたらタスクを保存
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['task'])) {
    $task = trim($_POST['task']);
    file_put_contents($filename, $task . PHP_EOL, FILE_APPEND);
}

// タスク一覧を取得
$tasks = file_exists($filename) ? file($filename, FILE_IGNORE_NEW_LINES) : [];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ToDoアプリ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>ToDoリスト</h1>
        <form method="post" action="">
            <input type="text" name="task" placeholder="タスクを入力" required>
            <button type="submit">追加</button>
        </form>

        <ul>
            <?php foreach ($tasks as $task): ?>
                <li><?= htmlspecialchars($task) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
