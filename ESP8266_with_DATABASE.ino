#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>
#include <WiFiClient.h>

// const char* ssid     = "VNPT_HUYENTRANG 1";
// const char* password = "07070707";

const char* ssid     = "VNPT_2.4G";
const char* password = "nguyen12345";

// const char* serverName = "http://lcn113.000webhostapp.com/esp_data.php";
const char* serverName = "http://funixproject3.000webhostapp.com/esp_data.php";
String apiKeyValue = "kjsjkhjdhfd";
String sensorName = "DS18B20";
String sensorLocation = "BEDROOM";

void setup() {
  Serial.begin(115200);

  //Connect to Wifi
  WiFi.begin(ssid, password);
  Serial.print("Connecting...");
  delay(1000);
  while(WiFi.status() != WL_CONNECTED) { 
    Serial.print(".");
    delay(250);
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
}

void loop() {
  if(WiFi.status()== WL_CONNECTED) {

    WiFiClient client;
    HTTPClient http;
    http.begin(client, serverName);

    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    // Prepare your HTTP POST request data
    String httpRequestData = "api_key=" + apiKeyValue + "&sensor=" + sensorName
    + "&location=" + sensorLocation + "&value1=" + "28 dC"
    + "&value2=5678"+"";
    Serial.print("httpRequestData: ");
    Serial.println(httpRequestData);

    // Send HTTP POST request
    int httpResponseCode = http.POST(httpRequestData);
    String payload = http.getString();
    if (httpResponseCode > 0) {
      Serial.print("HTTP Response code: ");
      Serial.println(httpResponseCode);
      Serial.println(payload);  
    }
    else {
      Serial.print("Error code: ");
      Serial.println(httpResponseCode);
    }

    http.end();

    //Send an HTTP POST request every 30 seconds
    delay(30000);
  }

  else {
    Serial.println("WiFi Disconnected");
    Serial.print(".");
    delay(250);
  }
}
