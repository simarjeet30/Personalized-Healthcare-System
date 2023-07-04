#include "DHT.h"
#define USE_ARDUINO_INTERRUPTS true   
#include <PulseSensorPlayground.h>

#define DHTPIN 2
#define DHTTYPE DHT11   // DHT 11
const int PulseWire = 0;     
const int LED13 = 13;      
int Threshold = 550;           
                               
PulseSensorPlayground pulseSensor;


DHT dht(DHTPIN, DHTTYPE);

void setup() {
  Serial.begin(9600);
  pulseSensor.analogInput(PulseWire);   
  pulseSensor.blinkOnPulse(LED13);
  pulseSensor.setThreshold(Threshold);
  dht.begin();
  pulseSensor.begin();
}

void loop() {
  delay(2000);
  
  float h = dht.readHumidity();
  float t = dht.readTemperature();

  if (isnan(h) || isnan(t)) {
    Serial.println(F("Failed to read from DHT sensor!"));
    return;
  }
  
  Serial.println(h);
  Serial.println(t);

  label: int myBPM = pulseSensor.getBeatsPerMinute();  
                                               

 if (pulseSensor.sawStartOfBeat()) {                       
 Serial.println(myBPM);    }
 else goto label;
}
