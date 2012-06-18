<?php

// Databaseへのアクセス
require('../lib/dbaccess.php');

// DBからスレッドデータを取得
$db = db_connect();
$sql = "select * from entity where thread = :id order by date desc";
$params = array(":id" => $_GET['id']);
$stmt = $db->prepare($sql); $stmt->execute($params);
$entitylist = $stmt->fetchAll(PDO::FETCH_ASSOC);

$json = json_encode($entitylist);
echo "$json";
?>