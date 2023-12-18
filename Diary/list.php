<?php
require("db_connect.php");

// 페이지 및 목록 크기 설정
$listSize = 5;
$page = $_GET["page"] ?? 1;
$start = ($page - 1) * $listSize;

// 데이터베이스에서 게시물 가져오기
$query = $db->query("SELECT * FROM board ORDER BY num DESC LIMIT $start, $listSize");
$posts = $query->fetchAll(PDO::FETCH_ASSOC);

// 페이징을 위한 전체 게시물 수 가져오기
$totalPostsQuery = $db->query("SELECT COUNT(*) FROM board");
$totalPosts = $totalPostsQuery->fetchColumn();

// 페이징 정보 구성
$pagination = [
    "currentPage" => $page,
    "totalPages" => ceil($totalPosts / $listSize),
];

// JSON 형식으로 응답
header("Content-Type: application/json");
echo json_encode(["posts" => $posts, "pagination" => $pagination]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
</head>
<body>
    <h1>게시판</h1>

    <div id="postList"></div>

    <script>
        // 페이지 로드 시 게시물 목록을 불러오는 함수
        function fetchPosts(page) {
            fetch(`list.php?page=${page}`)
                .then(response => response.json())
                .then(data => {
                    const postList = document.getElementById('postList');
                    postList.innerHTML = '';

                    data.posts.forEach(post => {
                        postList.innerHTML += `<div><h3>${post.title}</h3><p>${post.content}</p></div>`;
                    });

                    // 페이징 정보 출력
                    const pagination = data.pagination;
                    console.log(`현재 페이지: ${pagination.currentPage}, 전체 페이지: ${pagination.totalPages}`);
                });
        }

        // 페이지 로드 시 초기 데이터를 불러옴
        fetchPosts(1);
    </script>
</body>
</html>
