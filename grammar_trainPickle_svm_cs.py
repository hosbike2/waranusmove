import random
import re
import pickle
import grammar_feature
import nltk
import numpy as np
from sklearn import svm
from sklearn.model_selection import train_test_split
from sklearn.metrics import classification_report, confusion_matrix, accuracy_score
import os
func = []
countSent = 0
pos = " "
for i in range(1,61):
    read1 = tetxUpload/bio%d"%(i)
    read2 = ".txt"
    read3 = read1 + read2
    fileText = open(read3).read()
    sentT = nltk.sent_tokenize(fileText)
    lenS = float(len(sentT))/float(2)
    countSent = countSent + (len(sentT))
    for i,sent in enumerate(sentT):
        if i < 2 :
            pos = 1       #First
        elif i >= len(sentT)-2 :
            pos = 2       #Last
        else :
            pos = 3       #Ignore
        spl = sent.split(->)
        if spl[0] == [B] :
            func = func + ( [ (spl[1], 1, pos)] ) #Background
        elif spl[0] == [P] :
            func = func + ( [ (spl[1] , 2, pos)] )   #Purpose
        elif spl[0] == [M] :
            func = func + ( [ (spl[1], 3, pos)] )     #Method
        elif spl[0] == [R] :
            func = func + ( [ (spl[1], 4, pos)] )     #Result
        elif spl[0] == [D] :
            func = func + ( [ (spl[1] , 5, pos)] )#Discussion
random.shuffle(func)
x_featuresets = [(grammar_feature.grammar_feature(n,p)) for n,g,p in func]
y_featuresets = [result for n,result,p in func]
x_train, x_test, y_train, y_test = train_test_split(x_featuresets, y_featuresets, test_size=0.2, random_state=0)
classifier = svm.SVC(gamma='scale', decision_function_shape='ovo')
classifier = classifier.fit(x_train, y_train)
y_pred = classifier.predict(x_test)

with open('grammar_textclassifier_svm_cs.pickle','wb') as picklefile:
    pickle.dump(classifier,picklefile)

confustion = confusion_matrix(y_test,y_pred)
accuracy = accuracy_score(y_test, y_pred)
classification_report = classification_report(y_test,y_pred)

fOut = "report/report_grammar_svm_cs.txt"
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
