<?php
$tasks = file_exists('tasks.json') ? json_decode(file_get_contents('tasks.json'), true) : [];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>タスク管理システム</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="wrapper">
    <div class="todo-app">
        <h1>✨ My ToDo List ✨</h1>

        <form action="add.php" method="post" class="add-form">
            <input type="text" name="task" placeholder="新しいタスクを追加..." autocomplete="off" required>

            <!-- 日付プルダウン追加 -->
            <select name="due_date" required>
                <option value="">締切日を選択</option>
                <?php
                $today = new DateTime();
                for ($i = 0; $i <= 14; $i++) {  // 今日から2週間分
                    $date = $today->modify('+1 day')->format('Y-m-d');
                    echo "<option value='$date'>$date</option>";
                }
                ?>
            </select>

            <button type="submit">＋ 追加</button>
        </form>

        <ul class="task-list">
        <?php foreach ($tasks as $index => $task): ?>
            <li class="task-item">
                <form action="delete.php" method="post" class="inline-form">
                    <input type="hidden" name="index" value="<?= $index ?>">
                    <input type="checkbox" onchange="this.form.submit()">
                </form>
                <div class="task-info">
                    <span><?= htmlspecialchars($task['name']) ?></span>
                    <?php if (!empty($task['due_date'])): ?>
                        <small class="due-date">締切: <?= htmlspecialchars($task['due_date']) ?></small>
                    <?php endif; ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    </div>
</div>
</body>
</html>
