<?php
$db = __DIR__ . '/database/database.sqlite';
if (!file_exists($db)) {
    echo "NOFILE\n";
    exit(1);
}
$pdo = new PDO('sqlite:' . $db);
$tables = $pdo->query("SELECT name FROM sqlite_master WHERE type='table'")->fetchAll(PDO::FETCH_COLUMN);
echo implode(',', $tables) . "\n";
