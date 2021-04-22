#include <AX12A.h>

#define DirectionPin  (0)
#define BaudRate    (1000000)
#define ID    (3)

byte OUT = 13;
byte MASK_YES = 12;
byte ESP_PROC = 11;

const int trigPin = 2;
const int echoPin = 3;

float duration, distance;
sss
void setup() {
  pinMode(OUT, OUTPUT);
  pinMode(MASK_YES, INPUT);
  pinMode(ESP_PROC, INPUT);
  pinMode(trigPin, OUTPUT);
  pinMode(echoPin, INPUT);

  Serial.begin(9600);
  ax12a.begin(BaudRate, DirectionPin, &Serial);
  ax12a.setEndless(ID, ON);
}

void loop() {
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);

  duration = pulseIn(echoPin, HIGH);
  distance = (duration * .0343) / 2;
  Serial.print("Distance: ");
  Serial.println(distance);

  if ((distance < 10) && (digitalRead(MASK_YES) == HIGH) && (digitalRead(ESP_PROC) == LOW)) {
    pushSanitizer();
  }
  else {

    return;
  }
}
void pushSanitizer() {
  ax12a.ledStatus(ID, ON);
  ax12a.turn(ID, LEFT, 1000);
  delay(350);

  ax12a.ledStatus(ID, OFF);
  ax12a.turn(ID, RIGHT, 1000);
  delay(350);

  ax12a.turn(ID, RIGHT, 0);

  digitalWrite(OUT, HIGH);
  delay(1000);
  digitalWrite(OUT, LOW);
}
