#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <ESP8266WebServer.h>

ESP8266WebServer server(80);  // 웹서버 오브젝트

const char* ssid = "";
const char* password = "";

const int MQ136pin = A0; // MQ-136 센서의 아날로그 핀 번호
const int MQ137pin = A0; // MQ-137 센서의 아날로그 핀 번호 (다른 핀으로 변경)

const int port = 80; // 서버 포트 (일반적으로 80)

float sensorValue1; // MQ-136 센서 값을 저장할 변수
float sensorValue2; // MQ-137 센서 값을 저장할 변수

WiFiClient client;
HTTPClient http;

void connectToWiFi() {
  Serial.println("Connecting to WiFi...");
  WiFi.begin(ssid, password);

  // WiFi 연결 대기
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);  // 1초마다 연결 상태 확인
    Serial.print(".");
  }

  Serial.println("수신완료");  // WiFi 연결 완료
  Serial.print("Connected IP address: ");
  Serial.println(WiFi.localIP());
}


void setup() {
  Serial.begin(115200);
  Serial.println();
  delay(100);

  // Wi-Fi 연결 시도
  connectToWiFi();

  Serial.println("HTTP server started");
  server.on("/", handleRoot); // 루트에 접속 되었을때 실행할 함수 연결
    // HTTP 요청의 타임아웃 설정
  http.setTimeout(50000); // 5초 타임아웃
  server.begin(); // 웹서버 시작
}

void handleRoot() { // 루트에 접속할때 실행할 내용
  server.send(200, "text/plain", "hello from esp8266!");
  delay(100);
}

void loop() {
  server.handleClient();
  sensorValue1 = analogRead(MQ136pin); // MQ-136 센서의 아날로그 값을 읽음
  sensorValue2 = analogRead(MQ137pin); // MQ-137 센서의 아날로그 값을 읽음

  Serial.print("Sensor 136 Value: ");
  Serial.print(sensorValue1);

  Serial.print(" | Sensor 137 Value: ");
  Serial.print(sensorValue2);

  if (sensorValue1 > 300) {
    Serial.print(" | Gas 1 detected!"); // 기준 값보다 크면 가스가 감지됨을 표시
  }

  if (sensorValue2 > 300) {
    Serial.print(" | Gas 2 detected!"); // 기준 값보다 크면 가스가 감지됨을 표시
  }

  Serial.println("");

  if (WiFi.status() != WL_CONNECTED) {
    Serial.println("Wi-Fi 연결이 끊어졌습니다. 재부팅...");
    ESP.restart(); // ESP8266 재부팅
  }

  // 서버로 데이터 전송
  sendSensorDataToServer(sensorValue1, sensorValue2);

  delay(5000); // 2초 대기 후 다음 측정을 위한 딜레이
}

void sendSensorDataToServer(float value1, float value2) {
  // 서버 주소 설정
  String url = "http://ipaddress/your_php_script.php"; // 여기서 'your_php_script.php'를 수정해야 합니다.

  // 데이터 설정
  String data = "sensor1=" + String(value1) + "&sensor2=" + String(value2);

  // HTTP POST 요청 설정
  http.begin(client, url);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");

  int httpResponseCode = http.POST(data);

  // 응답 확인
  if (httpResponseCode > 0) {
    String response = http.getString();
    Serial.println("HTTP Response Code: " + String(httpResponseCode));
    Serial.println("Response: " + response);
  } else {
    Serial.println("HTTP POST 요청 실패.");
  }

  // HTTP 연결 종료
  http.end();
}