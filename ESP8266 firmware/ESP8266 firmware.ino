#include <Ticker.h>
#include <ESP8266WiFi.h>
#include <WiFiClient.h>
#define STATE_BLUE 13
#define STATE_GREEN 12
#define STATE_RED 15
#define AIRKISS 4
int led_state = HIGH;
bool ledState = 0;
const char* host = "192.168.1.102";
const int tcpPort = 8282;
unsigned char Re_buf[11], counter = 0, sign_one = 0, sign_two = 0, sign_three = 0, data_buf[30], data_count = 0, check_data = 0;
unsigned char rec, check_data_get, ID = 0,dump_sign=0;
int i, lastWiFiCheckTick;
int data_pm , data_co, data_pwm, data_temp, data_switch, switch_one, switch_two, switch_three, switch_four, switch_five;
int data_length = 0;
unsigned char sign = 0;
int flip_count = 0;
WiFiClient client;
Ticker flipper;

void flip()
{
  digitalWrite(STATE_BLUE, led_state);
  led_state = !led_state;
  flip_count++;

}

void data_display()
{
  data_pm = data_buf[0] << 8 ;
  data_pm  = data_pm + data_buf[1];
  data_co = data_buf[2] << 8 ;
  data_co = data_co  + data_buf[3];
  data_pwm = data_buf[4];
  data_temp = data_buf[5];
  data_switch = data_buf[6];
}

void data_receive()
{
  counter = 0; data_count = 0; sign_one = 0; sign_two = 0; sign_three = 0; check_data = 0; data_length = 0;
  for (i = 0; i < 20; i++)
  {
    data_buf[i] = 0;
    Re_buf[i] = 0;
  }
  //   Serial.println( counter);
  while (Serial.available()) {
    if (counter > 16 )  return;

    Re_buf[counter] = (unsigned char)Serial.read();
    if ( sign_one == 0 && Re_buf[counter] == 0x4f)
    {
      sign_one = 1;
    }
    else  if (sign_one == 1 && sign_two == 0 )
    {
      if (sign_two == 0 && Re_buf[counter] == 0x4b)
      {
        sign_two = 1;
      }
    }

    else if (sign_one == 1 && sign_two == 1 )
    {
      if (sign_three == 0)
      {
        if (Re_buf[counter] == 0x80) sign_three = 1;
      }
      else if (sign_three == 1)
      {
        if (data_length == 0)
        {
          data_length =  Re_buf[counter];

        }
        else
        {
          if (data_count < data_length)
          {
            data_buf[data_count] =  Re_buf[counter];
            data_count++;

          }
          else
          {
            check_data = Re_buf[counter];

          }
        }
      }
    }
    //    Serial.println( Re_buf[counter]);
    counter++;
  }

  if (counter)
  {
    data_display();
    client.print(String("AA") + ID + String("BB") + data_pm +
                 String("CC") + data_co + String("DD") + data_pwm +
                 String("EE") + data_temp + String("FF") + data_switch +
                 String("GG") + check_data +  String("HH"));
    //             client.print(data_pm+String("AA")+data_pm+String("BB"));
//    client.flush();
    dump_sign =1;
  }
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
      if(client.available())
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
              unsigned char hexdata[7] = {0x4f,0x4b,0x81,0x02,0x01,0x01,0x00};
              Serial.write(hexdata,7);
              }
              else  if(recv == '2')
            {
              unsigned char hexdata[7] = {0x4f,0x4b,0x81,0x02,0x01,0x00,0x00};
              Serial.write(hexdata,7);
              }
               else  if(recv == '3')
            {
              unsigned char hexdata[7] = {0x4f,0x4b,0x81,0x02,0x02,0x01,0x00};
              Serial.write(hexdata,7);
              }
               else  if(recv == '4')
            {
              unsigned char hexdata[7] = {0x4f,0x4b,0x81,0x02,0x02,0x00,0x00};
              Serial.write(hexdata,7);
              }
               else  if(recv == '5')
            {
              unsigned char hexdata[7] = {0x4f,0x4b,0x81,0x02,0x03,0x01,0x00};
              Serial.write(hexdata,7);
              }
               else  if(recv == '6')
            {
              unsigned char hexdata[7] = {0x4f,0x4b,0x81,0x02,0x03,0x00,0x00};
              Serial.write(hexdata,7);
              }
               else  if(recv == '7')
            {
              unsigned char hexdata[7] = {0x4f,0x4b,0x81,0x02,0x04,0x01,0x00};
              Serial.write(hexdata,7);
              }
               else  if(recv == '8')
            {
              unsigned char hexdata[7] = {0x4f,0x4b,0x81,0x02,0x04,0x00,0x00};
              Serial.write(hexdata,7);
              }
               else  if(recv == '9')
            {
              unsigned char hexdata[7] = {0x4f,0x4b,0x81,0x02,0x05,0x01,0x00};
              Serial.write(hexdata,7);
              }
               else  if(recv == '0')
            {
              unsigned char hexdata[7] = {0x4f,0x4b,0x81,0x02,0x05,0x00,0x00};
              Serial.write(hexdata,7);
              }
               else  if(recv == 'A')
            {
              unsigned char hexdata[6] = {0x4f,0x4b,0x82,0x01,0x00,0x00};
              Serial.write(hexdata,6);
              }

               else  if(recv == 'B')
            {
              unsigned char hexdata[6] = {0x4f,0x4b,0x82,0x01,0x14,0x00};
              Serial.write(hexdata,6);
              }
               else  if(recv == 'C')
            {
              unsigned char hexdata[6] = {0x4f,0x4b,0x82,0x01,0x28,0x00};
              Serial.write(hexdata,6);
              }
               else  if(recv == 'D')
            {
              unsigned char hexdata[6] = {0x4f,0x4b,0x82,0x01,0x3c,0x00};
              Serial.write(hexdata,6);
              }
               else  if(recv == 'E')
            {
              unsigned char hexdata[6] = {0x4f,0x4b,0x82,0x01,0x50,0x00};
              Serial.write(hexdata,6);
              }
               else  if(recv == 'F')
            {
              unsigned char hexdata[6] = {0x4f,0x4b,0x82,0x01,0x64,0x00};
              Serial.write(hexdata,6);
              }
      

              
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

  data_receive();


  connTick();
  //  client.print("ok");
  delay(1000);


}
