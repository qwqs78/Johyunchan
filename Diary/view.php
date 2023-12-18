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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>게시물 보기</title>
</head>
<body>
    <h1>게시물 보기</h1>

    <div id="postDetails"></div>

    <script>
        function fetchPostDetails(num) {
            fetch(`view.php?num=${num}`)
                .then(response => response.json())
                .then(data => {
                    const postDetails = document.getElementById('postDetails');
                    const post = data.post;

                    postDetails.innerHTML = `
                        <table>
                            <tr><th>작성자</th><td>${post.writer}</td></tr>
                            <tr><th>작성일시</th><td>${post.regtime}</td></tr>
                            <tr><th>조회수</th><td>${post.hits}</td></tr>
                            <tr><th>내용</th><td>${post.content}</td></tr>
                            <tr><th>사진</th><td><img src="${post.picture}"></td></tr>
                        </table>
                    `;
                })
                .catch(error => {
                    console.error('Error fetching post details:', error);
                });
        }

        // 페이지 로드 시 초기 데이터를 불러옴
        const urlParams = new URLSearchParams(window.location.search);
        const postNum = urlParams.get('num');
        fetchPostDetails(postNum);
    </script>
</body>
</html>
