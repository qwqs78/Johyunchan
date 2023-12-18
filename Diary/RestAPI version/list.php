<?php
$listSize = 5;
$page = $_GET["page"] ?? 1;
$start = ($page - 1) * $listSize;

require("db_connect.php");

$query = $db->query("SELECT * FROM board ORDER BY num DESC LIMIT $start, $listSize");
$posts = [];

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $posts[] = [
        "num" => $row["num"],
        "title" => $row["title"],
        "writer" => $row["writer"],
        "regtime" => $row["regtime"],
        "hits" => $row["hits"],
    ];
}

$totalPostsQuery = $db->query("SELECT COUNT(*) FROM board");
$totalPosts = $totalPostsQuery->fetchColumn();

$numPages = ceil($totalPosts / $listSize);

$pagination = [
    "currentPage" => $page,
    "totalPages" => $numPages,
];

header("Content-Type: application/json");
echo json_encode(["posts" => $posts, "pagination" => $pagination]);
?>