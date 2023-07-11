#Imports
import os,io
import numpy as np
import tensorflow as tf
import tensorflow_hub as hub
from PIL import Image
from tensorflow import keras
from flask import Flask, request, jsonify

#Load Model Architecture with weights
model = tf.keras.models.load_model("final_model.h5", custom_objects={'KerasLayer': hub.KerasLayer})

#Process the image and return Tensor
def process(image):
    data=np.asarray(image)
    data=data/255.0
    data=tf.image.resize(data,[224,224])
    return data

#Return Prediction Result
def predict(tensor):
    predictions=model(np.array([tensor]))
    res=np.argmax(predictions)
    return res

#Instantiate the App
app = Flask(__name__)
#Define Routes
@app.route("/api/image",methods=["GET","POST"])
#index
def index():
    if request.method=="POST":
        image_file = request.files['image']
        image_file.save('received_image.jpg')
        try:
            file=open("received_image.jpg", 'rb')
            image_bytes=file.read()
            image=Image.open(io.BytesIO(image_bytes))
            tensor = process(image)
            prediction=predict(tensor)
            data={"prediction":int(prediction)}
            return jsonify(data)
        except Exception as e:
            return jsonify({"error":str(e)})
    return "Server up and Running !"

if __name__ == "__main__":
    app.run(debug=True)