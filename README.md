# IOT projects

---

### The project consists of three parts 

- **ESP8266 firmware**

  The ESP8266 is a small chip which includes a MCU as well as the wireless module .By connecting to the TCP server , it makes possibility to remote control the MCU through the Web UI

  ![](https://steemitimages.com/DQmS8QV97x8MfsfDRd4CzBy9j4uU6QKzxuxPYF7D4XioPZU/%E5%9B%BE%E7%89%87.png)

  ​

- **workerman TCP server**

  TCP server serves as the bridge which connects the MCU and the Web UI

  ![](https://steemitimages.com/DQmQdYvbAjAUcC2Swd9ivb6ZxwwbCLsDCqEjZUHgpVgiqeN/%E5%9B%BE%E7%89%87.png)

  ​

- **Web UI**

  Web UI is a interface that vividly shows the control of the MCU

  ![](https://steemitimages.com/DQmUuWV5ysij3kkrW6RuRbZiZ5ugPusJbkgbgVd2MmTb3Dr/%E5%9B%BE%E7%89%87.png)

---

## Setup TCP server with workerman framework

- [Download to computer](https://github.com/Cha0s0000/IOT/tree/master/TCP%20server)

  ![](https://steemitimages.com/DQmVoWWGvuw8dmFo8XHnNYcrhjMymjTxFcnqshjPhPYt1hd/%E5%9B%BE%E7%89%87.png)

- Start up the TCP server

  ![](https://steemitimages.com/DQmZ621ByvQB9fpd1iydNBfDF3jzuYRy5b3EKsDrJ7MbR3m/%E5%9B%BE%E7%89%87.png)

  When it goes successfully ,it will show like this:

  ![](https://steemitimages.com/DQmQdYvbAjAUcC2Swd9ivb6ZxwwbCLsDCqEjZUHgpVgiqeN/%E5%9B%BE%E7%89%87.png)

  - **Remember the TCP server port : 8282**

---

## Upload firmware to ESP8266

- [Download](https://github.com/Cha0s0000/IOT/tree/master/ESP8266%20firmware) 

  ![](https://steemitimages.com/DQmUe2vWe5dXKYEb3VpqzC21j6QpAc2LazuoRCBBrPDzBA9/%E5%9B%BE%E7%89%87.png)



- When you download the code ,remember to modify your own TCP server host as well as the TCP server port

  ![](https://steemitimages.com/DQmQis5mffCtMpRkKg5Q3rcR2fTjLuXqWhKXADipWDkdH6b/%E5%9B%BE%E7%89%87.png)

  - **host** :host can be read by running **cmd.exe**  and input **ipconfig**

    ![](https://steemitimages.com/DQmdRNTfmbmnfPk3r3xYaZ9xzbs6EFCQSogz7PENs1df2Re/%E5%9B%BE%E7%89%87.png)

  - **port** :port can be read on workeman TCP server

    ![](https://steemitimages.com/DQmRcDoW5AJk74PR9KtUfJF26vBG9BniiGVcrpGhyvSfJuL/%E5%9B%BE%E7%89%87.png)



- Connect ESP8266 to computer COM and open Arduino IDE to upload the firmware

  For more detail,you can read my tutorials

  - [ESP8266 development tutorial--1](https://steemit.com/utopian-io/@cha0s0000/wifi-diy-wifi-or)
  - [ESP8266 development tutorial--2](https://steemit.com/utopian-io/@cha0s0000/esp8266-tutorials-http)
  - [ESP8266 development tutorial--3](https://steemit.com/utopian-io/@cha0s0000/esp8266-tutorials-web)
  - [ESP8266 development tutorial--4](https://steemit.com/utopian-io/@cha0s0000/esp8266-tutorials-esp8266)
  - [ESP8266 development tutorial--5](https://steemit.com/utopian-io/@cha0s0000/esp8266-tutorials-wifi)

---

## Deploy the Web UI  (Mobile version)

- Here I use the [phpstudy](http://www.phpstudy.net/) to setup the server(PHP+NGINX+MYSQL)

- Run the server and view the url

  ![](https://steemitimages.com/DQmNRqZfqcGKCRMiHqSge1gVDxoA955cDFDLEXBb8PLxLA7/%E5%9B%BE%E7%89%87.png)

---

## Realize remote controlling

- Let ESP8266 connect to WIFI by **smartconfig**

  [moer information about smartconfig](https://steemit.com/utopian-io/@cha0s0000/esp8266-tutorials-esp8266)

- Power on and control it

  ![GIF.gif](https://steemitimages.com/DQmYaPRYHNLxAKbQ4egJp7AieSAii3HZiqG1E8GoK51VPV2/GIF.gif)