#include <Ticker.h>
#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#define STATE_BLUE 13
#define STATE_GREEN 12
#define STATE_RED 15
#define AIRKISS 4
#include <dht11.h>  
int led_state = HIGH;
bool ledState = 0;
const char* host = "192.168.0.102";
const int tcpPort = 8282;
unsigned char Re_buf[11], counter = 0, sign_one = 0, sign_two = 0, sign_three = 0, data_buf[30], data_count = 0, check_data = 0;
unsigned char rec, check_data_get, ID = 0,dump_sign=0;
int i, lastWiFiCheckTick;
int data_pm , data_co, data_pwm, data_temp, data_switch, switch_one, switch_two, switch_three, switch_four, switch_five;
int data_length = 0;
unsigned char sign = 0;
int flip_count = 0;

//sensors  Pins
int AirQualityPin = 13;
int Temp&HumiPin = 12;
int VoicePin = 14;
int DistancePin = 16;
int LightPin = 15;
//sensors data
float AirQuality = 0;  
float temp=0;
float humi=0;
int Distance=0;
int Voice=0;
int Light=0;
WiFiClient client;
Ticker flipper;
dht11 DHT11;  

void getAirQuality()
{
   AirQuality = analogRead(AirQualityPin);  
   Serial.print("getAirQuality running.Get data :");
   Serial.println(AirQuality);
  }
void getDistance()
{
   Distance = analogRead(DistancePin);  
   Serial.print("getDistance running.Get data :");
   Serial.println(Distance);
  }
void  getVoice()
{
   Voice = analogRead(VoicePin);  
   Serial.print("getVoice running.Get data :");
   Serial.println(Voice);
  }
void  getLight()
{
   Light = analogRead(LightPin);  
   Serial.print("getLight running.Get data :");
   Serial.println(Light);
  }

void getHumi()
{
  DHT11.read(Temp&HumiPin);  
  humi = (float)DHT11.humidity;
  Serial.print("getHumi running.Get data :");
  Serial.println(humi);
  }
  
void getTemp()
{
  DHT11.read(Temp&HumiPin);  
  temp = (float)DHT11.temperature;
  Serial.print("getTemp running.Get data :");
  Serial.println(temp);
  }
  
void flip()
{
  digitalWrite(STATE_BLUE, led_state);
  led_state = !led_state;
  flip_count++;

}

void smartconfig()
{
  ESP.eraseConfig();
  flipper.attach(0.3, flip);
  WiFi.mode(WIFI_STA);
  Serial.println("\rWait for smartconfig");
 // WiFi.stopSmartConfig();
  WiFi.beginSmartConfig();
  while (1)
  {
    //ESP.wdtFeed();
    delay(300);
    Serial.print(".");
    if (WiFi.smartConfigDone())
    {
      Serial.println("smartconfig success");
      //      Serial.printf("SSID:%s\r\n",WiFi.SSID().c_str());
      //      Serial.printf("PSW:%s\r\n",WiFi.psk().c_str());
      Serial.println("SSID: " + WiFi.SSID());
      Serial.println("PSW: " + WiFi.psk());
      delay(10000);
      WiFi.stopSmartConfig();
      flipper.detach();
      break;
    }
  }
}
void waitKey()
{
  Serial.println("Short press key: smartconfig mode\r\nlong press key:factory restore mode");
  char keyCnt = 0;
  unsigned long preTick = millis();
  unsigned long preTick2 = millis();
  int num = 0;
  while (1)
  {
    ESP.wdtFeed();
    if (millis() - preTick < 10 ) continue;
    preTick = millis();
    num++;
    if (num % 10 == 0)
    {
      ledState = !ledState;
      digitalWrite(STATE_GREEN, ledState);
      Serial.print(".");
    }
    if (keyCnt >= 200)
    { //长按
      keyCnt = 0;
      Serial.println("\r\nLong Press key");

    }
    else if (keyCnt >= 5 && digitalRead(AIRKISS) == 0)
    { //短按
      keyCnt = 0;
      Serial.println("\r\nShort Press key");
      smartconfig();
    }
    if (digitalRead(AIRKISS) == 1) keyCnt++;
    else
      keyCnt = 0;

    if (millis() - preTick2 > 5 * 1000) break;
  }
  digitalWrite(STATE_BLUE, 0);
  digitalWrite(STATE_GREEN, 0);
  pinMode (STATE_BLUE, OUTPUT);
  pinMode (STATE_GREEN, OUTPUT);
  pinMode (5, OUTPUT);
  pinMode (4, OUTPUT);
  pinMode (0, OUTPUT);
  pinMode (2, OUTPUT);

}

void connTick()
{
  static bool wifi_status = true;
  static bool initial_start_tcp = false;
  if ( WiFi.status() != WL_CONNECTED ) {
    lastWiFiCheckTick++;
    if (lastWiFiCheckTick > 5) {
      Serial.println("wifi connect failed");
      ledState = !ledState;
      digitalWrite(STATE_RED, ledState);
    }
  }
  else {
    //Serial.println("wifi connect succ");
    lastWiFiCheckTick = 0;
    //    client.connect(host, tcpPort);
    if (!client.connected()) {
      client.connect(host, tcpPort);
      digitalWrite(STATE_RED, 0);
    }
    else if (client.connected())
    {
      if(dump_sign) 
      {
        client.print(String("DM") + ID + String("END") );
//        client.flush();
      }
      digitalWrite(STATE_RED, 1);
      while(client.available())
      {
//          String line = client.readStringUntil('{');
          
          char recv = client.read();
          if(recv == '{')
          {
            recv =client.read();
            client.flush();
            Serial.print(recv);
            if(recv == '1')
            {
              digitalWrite(5, 1);
              }
              else  if(recv == '2')
            {
               digitalWrite(5, 0);
              }
               else  if(recv == '3')
            {
               digitalWrite(4, 1);
              }
               else  if(recv == '4')
            {
               digitalWrite(4, 0);
              }
               else  if(recv == '5')
            {
               digitalWrite(0, 1);
              }
               else  if(recv == '6')
            {
               digitalWrite(0, 0);
              }
               else  if(recv == '7')
            {
               digitalWrite(2, 1);
              }
               else  if(recv == '8')
            {
               digitalWrite(2, 0);
              }
              
              break;
           }
          
        }
    }
  }
  //    ESP.wdtFeed();
}

void setup() {
  Serial.begin(9600);
  pinMode(4, INPUT);
  pinMode(STATE_GREEN, OUTPUT);
  pinMode(STATE_BLUE, OUTPUT);
  pinMode(STATE_RED, OUTPUT);
  waitKey();

  while (1)
  {
    connTick();
    if (WiFi.status() == WL_CONNECTED) break;
  }
  //  ESP.wdtDisable();//...........................

}

void loop() {
   getAirQuality();
   getDistance();
   getVoice();
   getLight();
   getHumi();
   getTemp();
   client.print(String("AA") + ID + String("BB") + AirQuality +
                 String("CC") + Distance + String("DD") + Voice +
                 String("EE") + Light + String("FF") + Humi +
                 String("GG") + Temp +  String("HH"));


  connTick();

}
