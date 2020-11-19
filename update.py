import firebase_admin
from firebase_admin import credentials
from firebase_admin import db
import sys

# Fetch the service account key JSON file contents
cred = credentials.Certificate('credentials.json')
# Initialize the app with a service account, granting admin privileges
firebase_admin.initialize_app(cred, {
    'databaseURL': 'https://project-d478b.firebaseio.com/.json'
})
ref = db.reference('DeviceState')
ref.update({
    sys.argv[1]: sys.argv[2]
})
print("Updated '", sys.argv[1], "' to '", sys.argv[2],"'")