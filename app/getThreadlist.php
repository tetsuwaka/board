<?php

// Databaseへのアクセス
require('../lib/dbaccess.php');

// DBからスレッドデータを取得
$db = db_connect();
$sql = "select id, title from bbs2 order by date desc";
$stmt = $db->prepare($sql); $stmt->execute();
$threadlist = $stmt->fetchAll(PDO::FETCH_ASSOC);

$json = json_encode($threadlist);
echo "$json";
?>