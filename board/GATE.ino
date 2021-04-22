#define TEMP_OK A0
#define TEMP_NO A1
#define SONAR_TRIG 2
#define SONAR_ECHO 3
#define HORN 13
#define BUTTON 4
#define LAMP 12

bool infinite = false;
bool tempOK = false;
bool tempNO = false;

void setup() {
  Serial.begin(9600);

  pinMode(SONAR_TRIG, OUTPUT);
  pinMode(SONAR_ECHO, INPUT);
  pinMode(HORN, OUTPUT);
  pinMode(BUTTON, INPUT);
  pinMode(LAMP, OUTPUT);

  hornDown();
}

void loop() {
  if (!infinite) {
    Serial.print("TEMP_OK: ");
    Serial.println(analogRead(TEMP_OK));

    Serial.print("TEMP_NO: ");
    Serial.println(analogRead(TEMP_NO));

    Serial.println(digitalRead(BUTTON));

    check();
  } else {
    hornUp();

    if (digitalRead(BUTTON) == HIGH) {
      infinite = false;
      hornDown();
    }
  }
}

void fireUp() {
  if (tempNO) {
    hornUp();
    delay(5000);
    tempNO = false;
  }

  if (tempOK) {
    bool walk = false;
    digitalWrite(LAMP, HIGH);

    while (true) {
      float dis = sonarUp();
      Serial.print("DISTANCE: ");
      Serial.println(dis);

      if ((dis < 150)) {
        Serial.println("WALKING...");
        walk = true;
      } else {
        if (walk) {
          break;
        }
      }
    }

    delay(450);
    tempOK = false;
    digitalWrite(LAMP, LOW);
  }

  if (sonarUp() < 150) {
    //    if (tempOK) {
    //      while (sonarUp() < 10) {
    //        Serial.println("WALKING...");
    //      }
    //      delay(350);
    //      tempOK = false;
    //    }

    if ((analogRead(TEMP_OK) < 500) && (analogRead(TEMP_NO) < 500)) {
      infinite = true;
      return;
    }
  }

  hornDown();
}

void check() {
  if (analogRead(TEMP_OK) > 500) {
    tempOK = true;
  }

  if (analogRead(TEMP_NO) > 500) {
    tempNO = true;
  }

  fireUp();
}

void hornUp() {
  digitalWrite(HORN, LOW);
}

void hornDown() {
  digitalWrite(HORN, HIGH);
}

float sonarUp() {
  digitalWrite(SONAR_TRIG, LOW);
  delayMicroseconds(2);
  digitalWrite(SONAR_TRIG, HIGH);
  delayMicroseconds(10);
  digitalWrite(SONAR_TRIG, LOW);

  float duration = pulseIn(SONAR_ECHO, HIGH);
  float distance = (duration * .0343) / 2;

  return distance;
}
