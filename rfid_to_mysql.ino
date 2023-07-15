#include "SPI.h"
#include <WiFi.h>
#include "MFRC522.h"

#define SS_PIN 5
#define RST_PIN 27

MFRC522 rfid(SS_PIN, RST_PIN);
MFRC522::MIFARE_Key key;

const char* ssid     = "Secret";
const char* password = "21212121";
const char* host = "192.168.43.60";

void setup() {
    Serial.begin(115200);
    SPI.begin();
    rfid.PCD_Init();
    Serial.println("Tap an RFID/NFC tag on the RFID-RC522 reader");

    Serial.println();
    Serial.println();
    Serial.print("Connecting to ");
    Serial.println(ssid);

    WiFi.begin(ssid, password);

    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
    }

    Serial.println("");
    Serial.println("WiFi connected");
    Serial.println("IP address: ");
    Serial.println(WiFi.localIP());


}
void loop() {
    if (!rfid.PICC_IsNewCardPresent() || !rfid.PICC_ReadCardSerial())
    return;

    MFRC522::PICC_Type piccType = rfid.PICC_GetType(rfid.uid.sak);

    if (piccType != MFRC522::PICC_TYPE_MIFARE_MINI &&
        piccType != MFRC522::PICC_TYPE_MIFARE_1K &&
        piccType != MFRC522::PICC_TYPE_MIFARE_4K) {
        Serial.println(F("Your tag is not of type MIFARE Classic."));
        return;
    }

    String strID = "";
    for (byte i = 0; i < 4; i++) {
        strID +=
        (rfid.uid.uidByte[i] < 0x10 ? "0" : "") +
        String(rfid.uid.uidByte[i], HEX) +
        (i!=3 ? ":" : "");
    }
    strID.toUpperCase();

    Serial.print("Tap card key: ");
    Serial.println(strID);

    rfid.PICC_HaltA();
    rfid.PCD_StopCrypto1();
}