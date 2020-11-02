import sys
import PIL.Image
import numpy
import requests
import time
from io import BytesIO
import json

res_image = requests.get(sys.argv[1])
#res_image = requests.get('https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/Left_side_of_Flying_Pigeon.jpg/1280px-Left_side_of_Flying_Pigeon.jpg')
image = img = PIL.Image.open(BytesIO(res_image.content))
image_np = numpy.array(image)

payload = {"instances": [image_np.tolist()]}
res = requests.post("http://163.239.25.44:8080/v1/models/default:predict", json=payload)

result = json.loads(res.content.decode('utf-8'))

scores = result['predictions'][0]['detection_scores']
boxes = result['predictions'][0]['detection_boxes']
labels = result['predictions'][0]['detection_classes']

label = ["person", "bicycle", "car", "motorcycle", "airplane", "bus", "train", "truck", "boat", "traffic light", "fire hydrant","", "stop sign", "parking meter", "bench", "bird", "cat", "dog", "horse", "sheep", "cow", "elephant", "bear", "zebra", "giraffe","", "backpack", "umbrella","","", "handbag", "tie", "suitcase", "frisbee", "skis", "snowboard", "sports ball", "kite", "baseball bat", "baseball glove", "skateboard", "surfboard", "tennis racket", "bottle","", "wine glass", "cup", "fork", "knife", "spoon", "bowl", "banana", "apple", "sandwich", "orange", "broccoli", "carrot", "hot dog", "pizza", "donut", "cake", "chair", "couch", "potted plant", "bed","", "dining table","","", "toilet","", "tv", "laptop", "mouse", "remote", "keyboard", "cell phone", "microwave", "oven", "toaster", "sink", "refrigerator","", "book", "clock", "vase", "scissors", "teddy bear", "hair drier", "toothbrush"]

index = 0

while index < len(scores) :
        if scores[index] >= 0.5:
                print(label[int(labels[index])-1] + '|' + str(scores[index]) + '|' + str(boxes[index]))
        index = index + 1

