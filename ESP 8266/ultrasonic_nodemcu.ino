#include <Servo.h> 

Servo myservo;

#define SERVOPIN D1
#define OUT D2
#define INP D3
#define trigPin D5 
#define echoPin D6

long duration; 
int distance; 
const int threshold=10;

void setup() {
    myservo.attach(SERVOPIN);
    pinMode(trigPin, OUTPUT); 
    pinMode(echoPin, INPUT);
    pinMode(INP, INPUT);
    pinMode(OUT, OUTPUT);
    digitalWrite(INP,LOW);
    digitalWrite(OUT,LOW);
    myservo.write(30);
    Serial.begin(9600); 
}
void loop() {
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);

  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);

  digitalWrite(trigPin, LOW);
  duration = pulseIn(echoPin, HIGH);
  
  distance = duration * 0.034 / 2; 
  
  if (distance >=5 && distance <=15) {
      Serial.print("Object detected within 5-15 cms of proximity with ");
      Serial.print("Distance: ");
      Serial.print(distance);
      Serial.println(" cm");
      digitalWrite(OUT, HIGH);
      delay(10000);
      if(digitalRead(INP)==HIGH)
      {
          myservo.write(120); 
          delay(2000);
          myservo.write(30);
      }
      else
      {
          myservo.write(-120);
          delay(2000);
          myservo.write(30);
      }
      digitalWrite(INP,LOW);
      digitalWrite(OUT,LOW);
      delay(1000);
  } 
  else 
  {
      digitalWrite(INP,LOW);
      digitalWrite(OUT,LOW);
      Serial.print("Object not present within 5-15 cms with ");
      Serial.print("Distance: ");
      Serial.print(distance);
      Serial.println(" cm");
  }

  myservo.write(60);
  delay(10000);
}
