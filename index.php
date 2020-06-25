<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'dbuser');
define('DB_PASSWORD', '********');
define('DB_NAME', 'dotinstall_paging_php');
define('COMMENTS_PER_PAGE', 5);

$page = 1;

error_reporting(E_ALL & ~E_NOTICE);

try {
    $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASSWORD);
} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}

// select * from commetns limit OFFSET, COUNT 何件目から何件引っ張ってくる
// page offset count
// 1    0      5
// 2    5      5
// 3    10      5

$offset = COMMENTS_PER_PAGE * ($page - 1);
$sql = "select * from comments limit".$offset.",".COMMENTS_PER_PAGE;
$comments = array();
foreach ($dbh->query($sql) as $row) {
    array_push($comments, $row);
}

// var_dump($comments);
// exit;




?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>コメント一覧</title>
</head>
<body>
    <h1>コメント一覧</h1>
    <ul>
    <?php foreach ($comments as $comment) : ?>
    <li><?php echo htmlspecialchars($comment['comment'],ENT_QUOTES,'UTF-8'); ?></li>
    <?php endforeach; ?>
    </ul>
</body>
</html>