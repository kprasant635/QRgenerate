# Python program to read
# json file

import json
import os

# Opening JSON file
f = open('datafileupload.json')

# returns JSON object as 
# a dictionary
data = json.load(f)

# Iterating through the json
# list
for i in data:
	print(i['firstname'])

# Closing file
f.close()

if os.path.exists("demofile.txt"):
  os.remove("demofile.txt")
else:
  print("The file does not exist")

