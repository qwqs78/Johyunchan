<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        table     { width:800px; text-align:center; margin-left:auto; margin-right:auto;font-size: 20px}
        table1    { width:800px; text-align:right; font-size: 20px}
        
        th        { background-color:#86E57F; }
        
        .time      { width: 200px; }
        .title    { width:1000px; }
       

        a         { text-decoration:none; }    
        a:link    { color:blue; }
        a:visited { color:blue; }
        a:hover   { color:red;  }
       
        .center     { text-align:center; }
        
        h1{
        font-size: 50px;
        font-weight:bold;
        color: sandybrown;
        }
    </style>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
	// 초기에 데이터가 처음으로 들어왔는지 여부를 저장할 변수
    var isFirstDataReceived = true;
	// 최신 데이터의 ID를 저장할 변수
    var latestDataId = null;
        // 페이지 로드 시 실행
        $(document).ready(function () {
            // 데이터 업데이트 함수 정의
            function updateData() {
                $.ajax({
                    url: "get_realtime_data.php", // 실시간 데이터를 가져올 PHP 스크립트 URL
                    method:  	"GET",
                    dataType: "json",
                    success: function (data) {
                        // 데이터를 표시할 HTML 엘리먼트 업데이트
                        $("#realtime-data").empty(); // "time" 데이터 업데이트
                        $("#realtime-content").empty(); // "content" 데이터 업데이트

						
						// 가져온 데이터를 반복해서 처리
                        $.each(data, function (index, item) {
                            // 시간과 센서 값 데이터를 표시할 위치에 추가
                            $("#realtime-data").append(item.time + "<br>");
                            $("#realtime-content").append(item.content + "<br>");
							
			
                    // 200이상 수치 감지시 표시
                    if (item.content === "200" && (latestDataId === null || item.id > latestDataId)) {
                        alert("데이터 값 이상입니다!");
                        isFirstDataReceived = false; // 다음에는 더 이상 알림창을 표시하지 않도록 변수 변경
                        latestDataId = item.id; // 최신 데이터의 ID 업데이트
                    }
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error("데이터 가져오기 오류: " + error);
                    }
                });
            }
			// 페이지 로드 시 최초 데이터 업데이트 실행
			updateData();

            // 주기적으로 데이터 업데이트 실행 (예: 5초마다)
            setInterval(updateData, 5000); // 5000 밀리초 (5초)마다 업데이트
        });
    </script>
</head>
<body>
<div style="text-align : center; margin-right:right;">
<h1><a href="data.php">데이터 창</a></h1></div>

<table>
    <tr>
        <th class="time"> 시간 </th>
        <th class="content">센서 값</th>
       
    </tr>
 
    <tr>
        <td id="realtime-data" class="time"></td> <!-- 시간 데이터가 표시될 위치 -->
        <td id="realtime-content" class="content"></td> <!-- 센서 값 데이터가 표시될 위치 -->
    </tr>
</table>

</body>
</html>
