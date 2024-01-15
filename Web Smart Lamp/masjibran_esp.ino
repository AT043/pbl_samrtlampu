#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
#include <SoftwareSerial.h>

const char* ssid = "ASUS_X00TD";
const char* password = "password";

int output5 = D5;
int output4 =D4;

ESP8266WebServer server(80);
SoftwareSerial node(D1,D2);

void setup() {
  Serial.begin(9600);
  pinMode(output4,OUTPUT);
  pinMode(output5,OUTPUT);

  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Konek ke wifi...");
  }
  Serial.println("Connected to WiFi, IP: ");
  Serial.print(WiFi.localIP());
  server.begin();

  server.on("/eksekusi-kode-A", HTTP_GET, [](){
    digitalWrite(output4, HIGH);
    server.sendHeader("Access-Control-Allow-Origin", "*");
    server.send(200, "application/json", "{\"status\": \"Kode A (Kedip) berhasil dijalankan\"}");
  });

  server.on("/eksekusi-kode-B", HTTP_GET, [](){
    digitalWrite(output4, LOW);
    server.sendHeader("Access-Control-Allow-Origin", "*");
    server.send(200, "application/json", "{\"status\": \"Kode B (Kedip) berhasil dijalankan\"}");
  });

  
}

void loop() {
  server.handleClient();
}
