<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>실시간 카메라 스트림</title>
    <style>     
        .center     { text-align:center; }
   
        h1 {
            font-size: 50px;
            font-weight:bold;
            color: black;
        }
        
        /* 비디오 컨테이너 스타일 */
        .video-container {
            display: block;
			width: 1000px;
            margin: auto;
            border: 10px solid magenta; /* 테두리 스타일 설정 */
            padding: 10px; /* 테두리와 비디오 사이의 간격 설정 */
        }
        
        video {
            display: block;
            width: 1000px; /* 부모 요소 크기에 맞게 비디오 크기 조정 */
			margin: 0 auto; /* 가운데 정렬 */
        }
    </style>
</head>
<body>
    <div style="text-align : center;">
        <h1>실시간 카메라 스트림<img src="new_icon.png" style="width:50px; height:50px;"/></h1><br>
    </div>
    <div class="video-container"> <!-- 비디오를 감싸는 컨테이너 -->
        <video id="camera-stream" autoplay></video>
    </div>

    <script>
        // 비디오 엘리먼트 및 웹캠 스트림 가져오기
        const videoElement = document.getElementById('camera-stream');

        // 브라우저가 웹캠 지원 여부를 확인
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function (stream) {
                    // 비디오 엘리먼트에 웹캠 스트림 할당
                    videoElement.srcObject = stream;
                })
                .catch(function (error) {
                    console.error('웹캠 스트림을 가져오는 중 오류 발생: ', error);
                });
        } else {
            console.error('웹캠을 지원하지 않는 브라우저입니다.');
        }
    </script>
</body>
</html>
