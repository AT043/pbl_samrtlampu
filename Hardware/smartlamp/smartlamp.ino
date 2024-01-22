#include <PCF8574.h>//using pcf8574 library if digital pins having a problem.
#include <ESP8266WiFi.h>
#include <ESP8266WebServer.h>
#include <SoftwareSerial.h>

#define timeSeconds 60

const char* ssid = "POCO-A";
const char* password = "";

boolean automodeToggle = false;
boolean startTimer1 = false;
boolean startTimer2 = false;
boolean startTimer3 = false;
boolean startTimer4 = false;
boolean motion1 = false;
boolean motion2 = false;
boolean motion3 = false;
boolean motion4 = false;
unsigned long now = millis();
unsigned long lastTrigger1 = 0;
unsigned long lastTrigger2 = 0;
unsigned long lastTrigger3 = 0;
unsigned long lastTrigger4 = 0;
////Relay in digital pin, use pcf8574 if your digital pin doesnt enough.
int output5 = D5;
int output4 = D4;
int output6 = D6;
int output7 = D7;
//PIR sensor in digital pin, use pcf8574 if your digital pin doesnt enough.
int PIR1 = P0;
int PIR2 = P1;
int PIR3 = P2;
int PIR4 = P3;
//UV sensor on analog pin.
int UV = A0;

float value;

PCF8574 pir (0x20);//assign address on pcf8574. not used if your digital pins are ok.
ESP8266WebServer server(80);
SoftwareSerial node(D1,D2);

void IRAM_ATTR deteksigerakan_1() {
  value = analogRead(UV);
  if(value <= 20 && automodeToggle == true) {
    digitalWrite(output4, HIGH);
    startTimer1 = true; 
    lastTrigger1 = millis();
  }
}

void IRAM_ATTR deteksigerakan_2() {
  value = analogRead(UV);
  if(value <= 20 && automodeToggle == true) {
    digitalWrite(output5, HIGH);
    startTimer2 = true; 
    lastTrigger2 = millis();
  }
}

void IRAM_ATTR deteksigerakan_3() {
  value = analogRead(UV);
  if(value <= 20 && automodeToggle == true) {
    digitalWrite(output6, HIGH);
    startTimer3 = true; 
    lastTrigger3 = millis();
  }
}

void IRAM_ATTR deteksigerakan_4() {
  value = analogRead(UV);
  if(value <= 20 && automodeToggle == true) {
    digitalWrite(output7, HIGH);
    startTimer4 = true; 
    lastTrigger4 = millis();
  }
}

void setup() {
  Serial.begin(9600);
  pinMode(output4,OUTPUT);
  pinMode(output5,OUTPUT);
  pinMode(output6,OUTPUT);
  pinMode(output7,OUTPUT);

  //set pir with pcf8574 to INPUT_PULLUP. If not using pcf8574, change it to pinMode().
  pir.pinMode(PIR1, INPUT_PULLUP);
  pir.pinMode(PIR2, INPUT_PULLUP);
  pir.pinMode(PIR3, INPUT_PULLUP);
  pir.pinMode(PIR4, INPUT_PULLUP);

  //set UV sensors to INPUT.
  pinMode(UV, INPUT);

  attachInterrupt(digitalPinToInterrupt(PIR1), deteksigerakan_1, RISING);
  attachInterrupt(digitalPinToInterrupt(PIR2), deteksigerakan_2, RISING);
  attachInterrupt(digitalPinToInterrupt(PIR3), deteksigerakan_3, RISING);
  attachInterrupt(digitalPinToInterrupt(PIR4), deteksigerakan_4, RISING);

  Serial.print("Init pcf8574...");
  if (pir.begin()) {
    Serial.println("OK");
  } else {
    Serial.println("KO");
  }

  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Konek ke wifi...");
  }
  Serial.println("Connected to WiFi, IP: ");
  Serial.print(WiFi.localIP());
  server.begin();

  server.on("/mode-auto-on", HTTP_GET, [](){
    automodeToggle = true;
    digitalWrite(output4, LOW);
    digitalWrite(output5, LOW);
    digitalWrite(output6, LOW);
    digitalWrite(output7, LOW);
    server.sendHeader("Access-Control-Allow-Origin", "*");
    server.send(200, "application/json", "{\"status\": \"Mode auto berhasil dinyalakan\"}");
  });

  server.on("/mode-auto-off", HTTP_GET, [](){
    automodeToggle = false;
    digitalWrite(output4, LOW);
    digitalWrite(output5, LOW);
    digitalWrite(output6, LOW);
    digitalWrite(output7, LOW);
    startTimer1 = false;
    motion1 = false;
    startTimer2 = false;
    motion2 = false;
    startTimer3 = false;
    motion3 = false;
    startTimer4 = false;
    motion4 = false;
    server.sendHeader("Access-Control-Allow-Origin", "*");
    server.send(200, "application/json", "{\"status\": \"Mode auto berhasil dimatikan\"}");
  });


  server.on("/eksekusi-kode-A", HTTP_GET, [](){
    if (automodeToggle = false){
      digitalWrite(output4, HIGH);
      server.sendHeader("Access-Control-Allow-Origin", "*");
      server.send(200, "application/json", "{\"status\": \"Kode A (Kedip) berhasil dijalankan\"}");
    }
    else{
      server.send(200, "application/json", "{\"status\": \"Mode auto sedang berjalan\"}");
    }
  });

  server.on("/eksekusi-kode-B", HTTP_GET, [](){
    if (automodeToggle = false){
      digitalWrite(output4, LOW);
      server.sendHeader("Access-Control-Allow-Origin", "*");
      server.send(200, "application/json", "{\"status\": \"Kode B (Kedip) berhasil dijalankan\"}");
    }
    else{
      server.send(200, "application/json", "{\"status\": \"Mode auto sedang berjalan\"}");
    }
  });

  server.on("/eksekusi-kode-C", HTTP_GET, [](){
    if (automodeToggle = false){
      digitalWrite(output5, HIGH);
      server.sendHeader("Access-Control-Allow-Origin", "*");
      server.send(200, "application/json", "{\"status\": \"Kode C (Kedip) berhasil dijalankan\"}");
    }
    else{
      server.send(200, "application/json", "{\"status\": \"Mode auto sedang berjalan\"}");
    }
  });

  server.on("/eksekusi-kode-D", HTTP_GET, [](){
    if (automodeToggle = false){
      digitalWrite(output5, LOW);
      server.sendHeader("Access-Control-Allow-Origin", "*");
      server.send(200, "application/json", "{\"status\": \"Kode D (Kedip) berhasil dijalankan\"}");
    }
    else{
      server.send(200, "application/json", "{\"status\": \"Mode auto sedang berjalan\"}");
    }
  });

  server.on("/eksekusi-kode-E", HTTP_GET, [](){
    if (automodeToggle = false){
      digitalWrite(output6, HIGH);
      server.sendHeader("Access-Control-Allow-Origin", "*");
      server.send(200, "application/json", "{\"status\": \"Kode E (Kedip) berhasil dijalankan\"}");
    }
    else{
      server.send(200, "application/json", "{\"status\": \"Mode auto sedang berjalan\"}");
    }
  });

  server.on("/eksekusi-kode-F", HTTP_GET, [](){
    if (automodeToggle = false){
      digitalWrite(output6, LOW);
      server.sendHeader("Access-Control-Allow-Origin", "*");
      server.send(200, "application/json", "{\"status\": \"Kode F (Kedip) berhasil dijalankan\"}");
    }
    else{
      server.send(200, "application/json", "{\"status\": \"Mode auto sedang berjalan\"}");
    }
  });

  server.on("/eksekusi-kode-G", HTTP_GET, [](){
    if (automodeToggle = false){
      digitalWrite(output7, HIGH);
      server.sendHeader("Access-Control-Allow-Origin", "*");
      server.send(200, "application/json", "{\"status\": \"Kode G (Kedip) berhasil dijalankan\"}");
    }
    else{
      server.send(200, "application/json", "{\"status\": \"Mode auto sedang berjalan\"}");
    }
  });

  server.on("/eksekusi-kode-H", HTTP_GET, [](){
    if (automodeToggle = false){
      digitalWrite(output7, LOW);
      server.sendHeader("Access-Control-Allow-Origin", "*");
      server.send(200, "application/json", "{\"status\": \"Kode H (Kedip) berhasil dijalankan\"}");
    }
    else{
      server.send(200, "application/json", "{\"status\": \"Mode auto sedang berjalan\"}");
    }
  });

}

void loop() {
  server.handleClient();
  now = millis();
  if(automodeToggle = true){
    if((digitalRead(output4) == HIGH) && (motion1 == false)) {
    Serial.println("MOTION DETECTED!!!");
    motion1 = true;
    }
    if(startTimer1 && (now - lastTrigger1 > (timeSeconds*1000))) {
    Serial.println("Motion stopped...");
    digitalWrite(output4, LOW);
    startTimer1 = false;
    motion1 = false;
    }

    if((digitalRead(output5) == HIGH) && (motion2 == false)) {
    Serial.println("MOTION DETECTED!!!");
    motion2 = true;
    }
    if(startTimer2 && (now - lastTrigger2 > (timeSeconds*1000))) {
    Serial.println("Motion stopped...");
    digitalWrite(output5, LOW);
    startTimer2 = false;
    motion2 = false;
    }

    if((digitalRead(output6) == HIGH) && (motion3 == false)) {
    Serial.println("MOTION DETECTED!!!");
    motion3 = true;
    }
    if(startTimer3 && (now - lastTrigger3 > (timeSeconds*1000))) {
    Serial.println("Motion stopped...");
    digitalWrite(output6, LOW);
    startTimer3 = false;
    motion3 = false;
    }

    if((digitalRead(output7) == HIGH) && (motion4 == false)) {
    Serial.println("MOTION DETECTED!!!");
    motion4 = true;
    }
    if(startTimer4 && (now - lastTrigger4 > (timeSeconds*1000))) {
    Serial.println("Motion stopped...");
    digitalWrite(output7, LOW);
    startTimer4 = false;
    motion4 = false;
    }
  }
}
