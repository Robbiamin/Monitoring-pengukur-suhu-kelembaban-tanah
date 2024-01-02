#include<ESP8266WiFi.h>
#include<ESP8266HTTPClient.h>

const char* ssid = "Muhammad's Galaxy A12";
const char* pass = "vohb9175";
const char* server = "http://192.168.153.251";

const int moistureSensorPin = A0; // Pin analog untuk sensor kelembaban tanah
int led_merah = 2 ;
int led_hijau = 0 ;

long zero = 0;
long jeda = 8000;

void setup() {
  Serial.begin(115200); // Mulai komunikasi serial dengan baud rate 9600
  //wifi koneksi
  WiFi.begin(ssid,pass);

  pinMode(led_merah, OUTPUT);
  pinMode(led_hijau, OUTPUT);

  while(WiFi.status() != WL_CONNECTED){
    delay(500);
    Serial.print(".");
  }

  Serial.println("wifi terhubung");
  
}


void loop() {

  int sensorValue = analogRead(moistureSensorPin); // Baca nilai dari sensor

  // Konversi nilai sensor ke persentase kelembaban (0-100%)
  int moisturePercentage = map(sensorValue, 0, 1023, 0, 100);
Serial.print("Data setip detik = ");  
Serial.println(moisturePercentage);  
delay(1000);
if (moisturePercentage <= 1){
  digitalWrite(led_merah, HIGH);
  digitalWrite(led_hijau, LOW);
}
if (moisturePercentage >= 2 ){
  digitalWrite(led_merah, LOW);
  digitalWrite(led_hijau, HIGH);
}

  if (millis() - zero > jeda){
  zero = millis();
  String URL = String("") + server + "/nodemcu_1/input.php?data_sensor="
  +String(sensorValue)+"&status="+String(moisturePercentage);
    Serial.println(URL);

    if(WiFi.status() == WL_CONNECTED){
      WiFiClient client;
      HTTPClient http;
      http.begin(client, URL);
      int httpcode = http.GET();
      if(httpcode > 0){
        String payload = http.getString();
        Serial.println(payload);
      }
      http.end();
    }
  }
}
