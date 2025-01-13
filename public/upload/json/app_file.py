import qrcode #Import The Module
import os
# import module 
import openpyxl 


def increase_quota():
	file1 = open("quota.txt", "r+")
	val=file1.read()
	print(val)
	new_val=int(val)+1
	print(new_val)
	file1.truncate()
	file1.write(str(new_val))
	file1.close()

def qr_generator(FNAME,LNAME,TEL_HOME,TEL_WORK,EMAIL,ORG,TITLE,ADDRESS,URL):   

	vcard='''BEGIN:VCARD
N:'''+str(FNAME)+''';'''+str(LNAME)+''';
TEL;TYPE=work,VOICE:'''+str(TEL_WORK)+'''
TEL;TYPE=home,VOICE:'''+str(TEL_HOME)+'''
TEL;TYPE=fax:
EMAIL:'''+EMAIL+'''
ORG:'''+str(ORG)+'''
TITLE:'''+str(TITLE)+'''
ADR;TYPE=WORK,PREF:;;'''+str(ADDRESS)+'''
URL:'''+str(URL)+'''
VERSION:3.0
END:VCARD''' 

	img = qrcode.make(vcard)

	type(img)
	filename=str(TEL_WORK)+"_"+FNAME+".png"
	img.save("/var/www/qrcodegenerate.ntb.one/public/upload/json/qr_code/"+filename) #Save the file
	# increase_quota()

# load excel with its path 
# Python program to read
# json file

import json

# Opening JSON file
f = open('/var/www/qrcodegenerate.ntb.one/public/upload/json/datafile.json')

# returns JSON object as 
# a dictionary
data = json.load(f)

# Iterating through the json
# list
for i in data:
    print(i['firstname'])
    try:
        qr_generator(i['firstname'],i['lastname'],i['telhome'],i['telwork'],i['email'],i['organization'],i['title'],i['address'],i['url'])
    except:
        print("error")
# Closing fil
f.close()

if os.path.exists("/var/www/qrcodegenerate.ntb.one/public/upload/json/datafile.json"):
  #os.remove("datafileupload.json")
  open('/var/www/qrcodegenerate.ntb.one/public/upload/json/datafile.json', 'w').close()
else:
  print("The file does not exist")
