import random
import re
import pickle
import lexical_feature
import nltk
import numpy as np
from sklearn import svm
from sklearn.model_selection import train_test_split
from sklearn.metrics import classification_report, confusion_matrix, accuracy_score
import os
func = []
countSent = 0
for i in range(1, 61):
    read = "tetxUpload/bio"+str(i)+".txt"
    fileText = open(read).read()
    sentT = nltk.sent_tokenize(fileText)
    lenS = float(len(sentT))/float(2)
    countSent = countSent + len(sentT)
    for i,sent in enumerate(sentT):
        spl = sent.split("->")
        if spl[0] == "[B]" :
            func = func + ( [ (spl[1], 1)] )  #Background
        elif spl[0] == "[P]" :
            func = func + ( [ (spl[1] , 2)] ) #Purpose
        elif spl[0] == "[M]" :
            func = func + ( [ (spl[1], 3)] )  #Method
        elif spl[0] == "[R]" :
            func = func + ( [ (spl[1], 4)] )  #Result
        elif spl[0] == "[D]" :
            func = func + ( [ (spl[1] , 5)] ) #Discussion

random.shuffle(func)
x_featuresets = [(lexical_feature.lexical_feature(n)) for n,g in func]
y_featuresets = [result for n,result in func]

x_train, x_test, y_train, y_test = train_test_split(x_featuresets, y_featuresets, test_size=0.2, random_state=0)
classifier = svm.SVC(gamma='scale', decision_function_shape='ovo')
classifier = classifier.fit(x_train, y_train)
y_pred = classifier.predict(x_test)

with open('lexical_textclassifier_svm_cs.pickle','wb') as picklefile:
    pickle.dump(classifier,picklefile)

confustion = confusion_matrix(y_test,y_pred)
accuracy = accuracy_score(y_test, y_pred)
classification_report = classification_report(y_test,y_pred)

fOut = "report/report_lexical_svm_cs.txt"
fh = open(fOut,"w")

str_confustion = str(confustion)
str_accuracy = str(accuracy)
str_classification_report = str(classification_report)

fh.writelines('Confusion matrix : \n')
fh.writelines(str_confustion+'\n\n')
fh.writelines('Accuracy : \n')
fh.writelines(str_accuracy+'\n\n')
fh.writelines('Classification report : \n')
fh.writelines(str_classification_report+'\n')
fh.close()
