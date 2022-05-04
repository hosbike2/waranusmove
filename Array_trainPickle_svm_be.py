import random
import re
import pickle
import Array_feature
import nltk
import numpy as np
from sklearn import svm
from sklearn.model_selection import train_test_split
from sklearn.metrics import classification_report, confusion_matrix, accuracy_score
import os
list_sentence = list()
path = 'textUpload/bio'
for index in range(1,61):
    nameFile = path+str(index)+'.txt'
    readAbs = open(nameFile).read()
    sent_tokenize = nltk.sent_tokenize(readAbs)
    move_before = 0   #first
    for sent in sent_tokenize :
        move_sent = sent.split('->')
        move      = move_sent[0]
        sentence  = move_sent[1]
        if   move == "[B]" :
            move = 1        #Background
        elif move == "[P]" :
            move = 2        #Purpose
        elif move == "[M]" :
            move = 3        #Method
        elif move == "[R]" :
            move = 4        #Result
        else :
            move = 5        #Discussion

        list_sentence.append((sentence,move_before,move))
        move_before = move

random.shuffle(list_sentence)
x_featuresets = [ (lexical_grammar_feature.lexical_grammar_feature(s,b)) for s,b,m in list_sentence]
y_featuresets = [result for s,b,result in list_sentence]

x_train, x_test, y_train, y_test = train_test_split(x_featuresets, y_featuresets, test_size=0.2, random_state=0)
classifier = svm.SVC(gamma='scale', decision_function_shape='ovo')
classifier = classifier.fit(x_train, y_train)
y_pred = classifier.predict(x_test)

with open('Array_textclassifier_svm_be.pickle','wb') as picklefile:
    pickle.dump(classifier,picklefile)

confustion = confusion_matrix(y_test,y_pred)
accuracy = accuracy_score(y_test, y_pred)
classification_report = classification_report(y_test,y_pred)

fOut = "report/report_Array_svm_be.txt"
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
