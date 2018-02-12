#include <ESP8266WiFi.h>
#include <WiFiClient.h>
const char* host = "1.steemitcha0s0000.applinzi.com";
const int httpsPort = 80;
char check,state;
const char* ssid     = "god";
const char* password = "zhangliuchen";
WiFiClient client;

void setup() {
  pinMode(14,OUTPUT);
  pinMode(12,OUTPUT);
 pinMode(5, OUTPUT);
  pinMode(4, OUTPUT);
  pinMode(0, OUTPUT);
  pinMode(2, OUTPUT);
  digitalWrite(12, LOW);
  Serial.begin(115200);
  digitalWrite(14, HIGH);
  delay(500);
  digitalWrite(14, LOW);
  delay(500);
  digitalWrite(14, HIGH);
  delay(500);
  digitalWrite(14, LOW);
  delay(500);
 WiFi.begin(ssid, password);
 while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
    client.connect(host, httpsPort);
}

void loop() {
while(!client.connect(host, httpsPort))
  { 
    digitalWrite(14, LOW);
    client.connect(host, httpsPort);
    delay(100);
   }
  
 if (client.connected())
  {
    digitalWrite(14, HIGH);
    client.print(String("POST ") + "/downup.php?token=weixin" + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "User-Agent: BuildFailureDetectorESP8266\r\n" +
               "Connection: close\r\n\r\n");
               delay(90);
    String line = client.readStringUntil('{');
    Serial.print(line);
    delay(80);
    state = client.read();
    delay(100);
    }
  if (state == '1')
  {
    digitalWrite(5, HIGH);
  }
   else if (state == '2')
    digitalWrite(5, LOW);
   else if (state == '3')
    digitalWrite(4, HIGH);
   else if (state == '4')
    digitalWrite(4, LOW);
   else if (state == '5')
    digitalWrite(0, HIGH);
   else if (state == '6')
    digitalWrite(0, LOW);
   else if (state == '7')
    digitalWrite(2, HIGH);
   else if (state == '8')
    digitalWrite(2, LOW); 
}
