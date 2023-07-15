#include <MD_Parola.h>
#include <MD_MAX72xx.h>
#include <SPI.h>

// Uncomment according to your hardware type
#define HARDWARE_TYPE MD_MAX72XX::FC16_HW
//#define HARDWARE_TYPES MD_MAX72XX::GENERIC_HW

// Defining size, and output pins
#define MAX_DEVICES 2
#define CS_PIN 5

// Create a new instance of the MD_Parola class with hardware SPI connection
MD_Parola myDisplay = MD_Parola(HARDWARE_TYPE, CS_PIN, MAX_DEVICES);
//MD_Parola myDisplayer = MD_Parola(HARDWARE_TYPES, CS_PIN, MAX_DEVICES);

void setup() {
  // Intialize the object
  myDisplay.begin();
  //myDisplayer.begin();

  // Set the intensity (brightness) of the display (0-15)
  myDisplay.setIntensity(0);
  //myDisplayer.setIntensity(0);
  // Clear the display
  myDisplay.displayClear();
  //myDisplayer.displayClear();
}

void loop() {
  
  myDisplay.setTextAlignment(PA_LEFT);
  myDisplay.print("<-0");
  delay(2000);

 
//  
//  myDisplay.setTextAlignment(PA_RIGHT);
//  myDisplay.print("2");
//  delay(2000);
//
//  myDisplay.setTextAlignment(PA_RIGHT);
//  myDisplay.print("3");
//  delay(2000);
//
//  myDisplayer.setTextAlignment(PA_LEFT);
//  //myDisplay.setInvert(true);
//  myDisplayer.print("->");
//  delay(2000);
//
//  myDisplay.setInvert(false);
//  myDisplay.print("5");
//  delay(2000);
}
