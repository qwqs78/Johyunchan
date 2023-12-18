<?php
session_start();

// 요청이 POST 메서드인지 확인
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"));

    // 필요한 데이터가 제대로 전달되었는지 확인
    if (!$data || !isset($data->title, $data->writer, $data->content, $data->picture)) {
        http_response_code(400);
        header("Content-Type: application/json");
        echo json_encode(["error" => "모든 항목이 빈칸 없이 입력되어야 합니다."]);
        exit;
    }

    // 받아온 데이터로 게시물 추가 처리
    $title = $data->title;
    $writer = $data->writer;
    $content = $data->content;
    $picture = $data->picture;
    $regtime = date("Y-m-d H:i:s");

    require("db_connect.php"); // DB 접속

    $query = $db->prepare("INSERT INTO board (writer, title, content, regtime, hits, picture) VALUES (?, ?, ?, ?, 0, ?)");
    $query->execute([$writer, $title, $content, $regtime, $picture]);

    header("Content-Type: application/json");
    echo json_encode(["message" => "게시물이 성공적으로 추가되었습니다."]);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        table { width: 680px; margin: 0 auto; text-align: center; }
        th    { width: 100px; background-color: pink; }
        input[type=text], textarea { width: 100%; }

        .button-container {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form method="post" action="insert.php">
        <table>
            <tr>
                <th>제목</th>
                <td><input type="text" name="title" maxlength="80"></td>
            </tr>
            <tr>
                <th>작성자</th>
                <td><input type="text" name="writer" maxlength="20" value="<?=$_SESSION["userName"]?>" readonly></td>
            </tr>
            <tr>
                <th>사진이름</th>
                <td><input type="text" name="picture" maxlength="80"></td>
            </tr>
            <tr>
                <th>내용</th>
                <td><textarea name="content" rows="10"></textarea></td>
            </tr>
        </table>
        <br>
        <div class="button-container">
            <input type="submit" value="저장">
            <input type="button" value="취소" onclick="history.back()">
        </div>
    </form>
</body>
</html>
