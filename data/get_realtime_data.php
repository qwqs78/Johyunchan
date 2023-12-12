<?php
// 데이터베이스 연결 설정
$db_host = 'localhost'; // 호스트 주소
$db_name = 'phpdb';   // 데이터베이스 이름
$db_user = 'php'; // 데이터베이스 사용자 이름
$db_pass = '1234'; // 데이터베이스 비밀번호

try {
    // 데이터베이스 연결
    $db = new PDO("mysql:host=$db_host;port=3307;dbname=$db_name;charset=utf8", $db_user, $db_pass);
} catch (PDOException $e) {
    echo '데이터베이스 연결 실패: ' . $e->getMessage();
    exit;
}

// 최신 데이터를 가져오는 SQL 쿼리
$query = $db->query("SELECT time,content,sensor2 FROM data ORDER BY time DESC LIMIT 5");

if ($query) {
    // 결과가 있으면 데이터를 배열로 모두 저장
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as &$row) {
        $row['time'] = date('Y-m-d H:i:s', strtotime($row['time']));
    }
    echo json_encode($result);
} else {
    // 결과가 없으면 오류 메시지 반환
    echo json_encode(['error' => '데이터를 가져오는데 실패했습니다.']);
}
?>
