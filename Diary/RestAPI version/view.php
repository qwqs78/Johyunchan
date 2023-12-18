<?php
require("db_connect.php");

$num = $_GET["num"] ?? null;

if (!$num) {
    http_response_code(400);
    header("Content-Type: application/json");
    echo json_encode(["error" => "게시물 번호가 전달되지 않았습니다."]);
    exit;
}

$query = $db->prepare("SELECT * FROM board WHERE num = ?");
$query->execute([$num]);
$post = $query->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    http_response_code(404);
    header("Content-Type: application/json");
    echo json_encode(["error" => "해당 게시물을 찾을 수 없습니다."]);
    exit;
}

header("Content-Type: application/json");
echo json_encode(["post" => $post]);
?>
