#include <WiFiClient.h>
#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <SPI.h>
#include <MFRC522.h>
#include <Wire.h>
#include <Adafruit_MLX90614.h>

// PIN CONFIGURATION FOR MFRC
#define SS_PIN D4  //D2
#define RST_PIN D3 //D1

// GLOBAL INSTANCES
Adafruit_MLX90614 mlx = Adafruit_MLX90614();
MFRC522 mfrc(SS_PIN, RST_PIN);
HTTPClient http;
WiFiClient client;

// GLOBAL VARIABLES
//const String host = "http://192.168.43.88/api/store?";
const String host = "http://sapi.traper.my.id/api/store?";

//const char* ssid = "WIFI Gratis";
//const char* password = "12345678";
const char* ssid = "tplink";
const char* password = "2482482489";

// COM SANITIZER IN OUT
const byte SAN_OK = D0;
const byte SAN_TRIGGER = D8;
bool ready = false;

// COM HORN CONTROL
#define HORN_OK D9
#define HORN_NO D10

void setup() {
  Serial.begin(9600);

  pinMode(SAN_OK, INPUT);
  pinMode(SAN_TRIGGER, OUTPUT);

  pinMode(HORN_OK, OUTPUT);
  pinMode(HORN_NO, OUTPUT);

  WiFi.disconnect();
  delay(100);
  WiFi.begin(ssid, password);
  Serial.println("Connecting WiFi...");

  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
  }

  Serial.println();
  Serial.print("Connected, IP address: ");
  Serial.println(WiFi.localIP());

  SPI.begin();
  mfrc.PCD_Init();
  mlx.begin();
}

void loop() {
  // WiFi check
  if (WiFi.status() != WL_CONNECTED) {
    WiFi.disconnect();
    delay(100);
    WiFi.begin(ssid, password);

    while (WiFi.status() != WL_CONNECTED) {
      delay(500);
      Serial.print(".");
    }
  }

  // check ready to scan or not
  if (digitalRead(SAN_OK) == HIGH) {
    ready = true;
    sanDown();
  }

  if (!ready) {
    delay(500);
    return;
  }

  // Look for new cards
  if ( !mfrc.PICC_IsNewCardPresent())
  {
    return;
  }

  // Select one of the cards
  if ( !mfrc.PICC_ReadCardSerial())
  {
    return;
  }

  Serial.println("==================BEGIN==================");

  //READ RFID & TEMP
  String rfid = readRFID();
  String temp = getTemp();

  //   SEND DATA
  String response = sendData(rfid, temp);
  //   END SEND DATA

  // GATE
  if (isVerified(response, temp.toFloat())) {
    //    openGate(temp.toFloat());
    digitalWrite(HORN_OK, HIGH);
    delay(500);
    Serial.println("GATE OPENED");
  } else {
    digitalWrite(HORN_NO, HIGH);
    delay(500);
    Serial.println("GATE CLOSED");
  }

  Serial.println("===================END===================");
  reset();
  delay(500);
}

void reset() {
  ready = false;
  sanUp();
  digitalWrite(HORN_OK, LOW);
  digitalWrite(HORN_NO, LOW);
}

void sanDown() {
  digitalWrite(SAN_TRIGGER, HIGH);
}

void sanUp() {
  digitalWrite(SAN_TRIGGER, LOW);
}

String readRFID() {
  Serial.print("UID tag : ");
  String rfid_content = "";
  byte letter;

  for (byte i = 0; i < mfrc.uid.size; i++)
  {
    Serial.print(mfrc.uid.uidByte[i] < 0x10 ? " 0" : " ");
    Serial.print(mfrc.uid.uidByte[i], HEX);
    rfid_content.concat(String(mfrc.uid.uidByte[i] < 0x10 ? " 0" : " "));
    rfid_content.concat(String(mfrc.uid.uidByte[i], HEX));
  }

  rfid_content.toUpperCase();
  Serial.println();

  MFRC522::PICC_Type piccType = mfrc.PICC_GetType(mfrc.uid.sak);
  Serial.println(mfrc.PICC_GetTypeName(piccType));

  return rfid_content.substring(1);
}

String sendData(String rfid, String temp) {
  String request_string = host;
  String response;

  rfid.replace(" ", "%20");
  request_string += "rfid=" + rfid;
  request_string += "&temp=" + temp;

  Serial.println("Sending...");
  http.useHTTP10(true);
  http.begin(request_string.c_str());
  http.GET();
  response = http.getString();
  http.end();
  Serial.println("Sent!");

  return response;
}

String getTemp() {
  String temp(mlx.readObjectTempC());
  Serial.println("Temp: " + temp + " C");
  return temp;
}

bool isVerified(String response, float temp) {
  bool accountVerified = response.indexOf("true") > 0;

  if (accountVerified) {
    Serial.println("Account verified!");
  } else {
    Serial.println("Account unverified!");
  }

  if (accountVerified && temp < 37) {
    return true;
  } else {
    return false;
  }
}

void openGate(float temp) {
  digitalWrite(HORN_OK, HIGH);
  Serial.println("GATE OPENED");
}
