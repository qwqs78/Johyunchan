<?php
// POST 데이터를 받아옴
$data = json_decode(file_get_contents("php://input"));

// 필요한 데이터가 제대로 전달되었는지 확인
if (!$data || !isset($data->title, $data->name, $data->content, $data->picture)) {
    http_response_code(400);
    header("Content-Type: application/json");
    echo json_encode(["error" => "모든 항목이 빈칸 없이 입력되어야 합니다."]);
    exit;
}

// 받아온 데이터로 게시물 추가 처리
$title = $data->title;
$name = $data->name;
$content = $data->content;
$picture = $data->picture;
$regtime = date("Y-m-d H:i:s");

require("db_connect.php"); // DB 접속

$query = $db->prepare("INSERT INTO board (writer, title, content, regtime, hits, picture) VALUES (?, ?, ?, ?, 0, ?)");
$query->execute([$name, $title, $content, $regtime, $picture]);

header("Content-Type: application/json");
echo json_encode(["message" => "게시물이 성공적으로 추가되었습니다."]);
?>
