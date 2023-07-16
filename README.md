# NodeMCU-ML-Waste-Classifier

<p align="center"><img src="https://github.com/Srinath-13/NodeMCU-ML-Waste-Classifier/assets/79263421/e86d5e04-6ac4-4571-9306-42acd305d8a9" width=150 ></p>

Wastebot's goal is to 
develop an in-house tool that would assist people in sorting their trash before throwing it 
away. Using a Convolutional Neural Network (ResNet50), the proposed work aimed to 
create an image classifier that identifies the object and detects the type of waste material, 
and classifies it to six different classes, paper, cardboard, glass, plastic, trash, and metal. 
The ESP32 CAM captures the image of the garbage, and the machine learning model 
classifies it into one of the six categories, which are grouped into recyclable (paper, 
cardboard) and non-recyclable (plastic, glass, metal, trash). Once the trash has been 
classified, it is put into the appropriate portions of the bin, and the model uses ESP8266 
and a servo motor to operate this.

## Requirements
### Hardware
● ESP32
● ESP8266
● FTDI Board
● Ultrasonic Sensor
● Servo Motor
● Jump Wires

### Software
● Python
● Tensorflow
● PHP
● Flask
● Colab
● Kaggle
● Arduino IDE
● VSCode

## Prototype

<p align="center"><img src="https://github.com/Srinath-13/NodeMCU-ML-Waste-Classifier/assets/79263421/48e34aa3-aed2-42ed-b79a-83ff16204956"></p>

<p align="center"><img src="https://github.com/Srinath-13/NodeMCU-ML-Waste-Classifier/assets/79263421/25c38b15-1ecb-4233-a176-77e4e28ad09d"></p>


## Walkthrough
The below sequence of images depicts the process of waste segregation. The ultrasonic 
sensor first correctly determines whether or not an object is present within a proximity of 
5 cm to 15 cm. The ESP32 camera module is prompted to capture a picture of the identified 
object as soon as its presence is recognised. The captured image is then sent as a stream of 
bytes to the PHP server, where it is then sent to the Flask server, where the data is classified 
by the pre-trained ML model. Paper, cardboard, and rubbish are classified as recyclable 
waste, however the other waste types are not. Once the classification has been completed, 
the matching signal—high for recyclable materials and low for non recyclable—is 
delivered back to the PHP server, which then relays the findings to the ESP32. This signal 
is subsequently transmitted to the ESP8266, which activates the attached servo motor. The 
servo motor turns to the right when the signal is high, which indicates recyclable waste, 
and to the left when the signal is low, which indicates non-recyclable waste, pushing the 
rubbish to the left partition. The proper outcomes are acquired for various forms of garbage 
thanks to the efficient operation of this process

<details>
  <summary>User opens the bin</summary>
  <img src="https://github.com/Srinath-13/NodeMCU-ML-Waste-Classifier/assets/79263421/dfd36b6d-fcfe-4e4e-82f1-8702ad7f0182">
</details>

<details>
  <summary>User places the object on the flap</summary>
  <img src="https://github.com/Srinath-13/NodeMCU-ML-Waste-Classifier/assets/79263421/07f0cd6e-e862-4159-8a62-94de6cd666b2" >
</details>


<details>
  <summary>Output detected by Ultrasonic Sensor</summary>
  <img src="https://github.com/Srinath-13/NodeMCU-ML-Waste-Classifier/assets/79263421/9761c737-fbc1-4c49-ae5c-54804dc96429">
</details>


<details>
  <summary>Image Captured by ESP32 CAM</summary>
  <img src="https://github.com/Srinath-13/NodeMCU-ML-Waste-Classifier/assets/79263421/a7b93e47-5f99-4e34-824d-e641fcbd7ca9" >
</details>


<details>
  <summary>Image transmitted to PHP Server</summary>
  <img src="https://github.com/Srinath-13/NodeMCU-ML-Waste-Classifier/assets/79263421/1638a818-73d9-45c8-a3ff-a5fbc10dfd87" >
</details>


<details>
  <summary>Prediction Result (From Flask ML Server via PHP Server)</summary>
  <img src="https://github.com/Srinath-13/NodeMCU-ML-Waste-Classifier/assets/79263421/d611179f-0f04-492e-8110-3a5e869326d6">
</details>


<details>
  <summary>Flap rotation to segregate the waste</summary>
  <img src="https://github.com/Srinath-13/NodeMCU-ML-Waste-Classifier/assets/79263421/bdf1496c-95a3-4d24-b41a-13596a65028c" >
</details>


<details>
  <summary>Flap reset to Normal</summary>
  <img src="https://github.com/Srinath-13/NodeMCU-ML-Waste-Classifier/assets/79263421/a6626c43-924f-4a00-a15d-58f488f91db7" >
</details>




