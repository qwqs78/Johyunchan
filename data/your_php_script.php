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


if (isset($_POST['sensor1']) && isset($_POST['sensor2'])) {
    $sensorValue1 = floatval($_POST['sensor1']);
	$sensorValue2 = floatval($_POST['sensor2']);
	
	// 현재 시간을 가져오기
    $currentTime = date('Y-m-d H:i:s');

    // 데이터베이스에 저장
    $query = $db->prepare("INSERT INTO data (time, content, sensor2) VALUES (:time, :sensor1, :sensor2)");
    $query->bindParam(":time", $currentTime);
    $query->bindParam(":content", $sensorValue1, PDO::PARAM_STR);
	$query->bindParam(":sensor2", $sensorValue2, PDO::PARAM_STR);
    
 if ($query->execute()) {
        echo "센서 데이터 수신 및 저장: Sensor1=$sensorValue1, Sensor2=$sensorValue2";
    } else {
        echo "데이터를 저장하지 못했습니다.";
	}
} else {
    echo "잘못된 요청입니다.";
}
?>
