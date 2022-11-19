
import numpy as np
from flask import Flask, request, jsonify, render_template
import pickle

import requests

# NOTE: you must manually set API_KEY below using information retrieved from your IBM Cloud account.
API_KEY = "81vQsHpva8hIrUtwf-cc_Fda_ztKDmkMjZHoqYJ0okpz"
token_response = requests.post('https://iam.cloud.ibm.com/identity/token', data={"apikey": API_KEY, "grant_type": 'urn:ibm:params:oauth:grant-type:apikey'}) 
mltoken = token_response.json()["access_token"]

header = {'Content-Type': 'application/json', 'Authorization': 'Bearer ' + mltoken}


app = Flask(__name__)
#model = pickle.load(open('university.pkl', 'rb'))

@app.route('/')
def home():
    return render_template('index.html')

@app.route('/predict',methods=['POST'])
def predict():
    '''
    For rendering results on HTML GUI
    '''
    int_features = [float(x) for x in request.form.values()]
    #sample = [str(sample2) for sample2 in int_features]
    final_features = [np.array(int_features)]
    #'Gre','TOEFL','University','SOP','LOR','CGPA','Research']
#[['GRE Score','TOEFL Score','University Rating','SOP','LOR','CGPA','Research']]
    payload_scoring = {"input_data": [{"fields": [['GRE Score','TOEFL Score','University Rating','SOP','LOR','CGPA','Research']], "values": [int_features]}]}

    response_scoring = requests.post('https://us-south.ml.cloud.ibm.com/ml/v4/deployments/ee3ac5c7-dc6f-4b37-a361-bca99df3cf96/predictions?version=2022-11-18', json=payload_scoring, headers={'Authorization': 'Bearer ' + mltoken})
    #print("response_scoring : ")
    pred_new = response_scoring.json()
    pred_latest = pred_new['predictions'][0]['values'][0][0]
    #print(response_scoring.json())


    #prediction = model.predict(final_features)

    #output = round(prediction[0], 2)
    #output = prediction[0]
    return render_template('index.html', prediction_text='Chance of admit should be {}'.format(pred_latest))


if __name__ == "__main__":
    app.run(debug=True)

@app.route('/predict_api',methods=['POST'])
def predict_api():
    '''
    For direct API calls trought request
'''
    data = request.get_json(force=True)
    #prediction = model.predict([np.array(list(data.values()))])

    #output = prediction[0]
    #return jsonify(output)
