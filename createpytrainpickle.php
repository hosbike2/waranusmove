
<?php
 function createPyTrainPickle($feature,$model,$field) {
  
  $Filename = $feature."_trainPickle_".$model."_".$field.".py";
  #echo $Filename;
  $objFopen = fopen($Filename, 'w');
  $strText = "import random\r\n";
  fwrite($objFopen, $strText);
  $strText = "import re\r\n";
  fwrite($objFopen, $strText);
  $strText = "import pickle\r\n";
  fwrite($objFopen, $strText);
  $strText = "import ".$feature."_feature"."\r\n";
  fwrite($objFopen, $strText);
  $strText = "import nltk\r\n";
  fwrite($objFopen, $strText);
  $strText = "import numpy as np\r\n";
  fwrite($objFopen, $strText);

  if($model == "svm"){
  	$strText = "from sklearn import svm\r\n";
    fwrite($objFopen, $strText);
  }elseif($model == "tree"){
  	$strText = "from sklearn import tree\r\n";
    fwrite($objFopen, $strText);
  }elseif($model == "GaussianNB"){
  	$strText = "from sklearn.naive_bayes import GaussianNB\r\n";
    fwrite($objFopen, $strText);
  }else{
  	$strText = "from sklearn.ensemble import RandomForestClassifier\r\n";
    fwrite($objFopen, $strText);
  }
  
  $strText = "from sklearn.model_selection import train_test_split\r\n";
  fwrite($objFopen, $strText);
  $strText = "from sklearn.metrics import classification_report, confusion_matrix, accuracy_score\r\n";
  fwrite($objFopen, $strText);
  $strText = "import os";
  fwrite($objFopen, $strText);
  $strText = "\r\n";
  fwrite($objFopen, $strText);

  if($feature == "lexical"){
  $strText = "func = []\r\n";
  fwrite($objFopen, $strText);
  $strText = "countSent = 0\r\n";
  fwrite($objFopen, $strText);
  $strText = "for i in range(1, 61):\r\n";
  fwrite($objFopen, $strText);
  $strText = '    read = "textUpload/bio"+str(i)+".txt"'."\r\n";
  fwrite($objFopen, $strText);
  $strText = '    fileText = open(read).read()'."\r\n";
  fwrite($objFopen, $strText);
  $strText = '    sentT = nltk.sent_tokenize(fileText)'."\r\n";
  fwrite($objFopen, $strText);
  $strText = '    lenS = float(len(sentT))/float(2)'."\r\n";
  fwrite($objFopen, $strText);
  $strText = '    countSent = countSent + len(sentT)'."\r\n";
  fwrite($objFopen, $strText);
  $strText = '    for i,sent in enumerate(sentT):'."\r\n";
  fwrite($objFopen, $strText);
  $strText = '        spl = sent.split("->")'."\r\n";
  fwrite($objFopen, $strText);
  $strText = '        if spl[0] == "[B]" :'."\r\n";
  fwrite($objFopen, $strText);
  $strText = '            func = func + ( [ (spl[1], 1)] )  #Background'."\r\n";
  fwrite($objFopen, $strText);
  $strText = '        elif spl[0] == "[P]" :'."\r\n";
  fwrite($objFopen, $strText);
  $strText = '            func = func + ( [ (spl[1] , 2)] ) #Purpose'."\r\n";
  fwrite($objFopen, $strText);
  $strText = '        elif spl[0] == "[M]" :'."\n";
  fwrite($objFopen, $strText);
  $strText = '            func = func + ( [ (spl[1], 3)] )  #Method'."\r\n";
  fwrite($objFopen, $strText);
  $strText = '        elif spl[0] == "[R]" :'."\r\n";
  fwrite($objFopen, $strText);
  $strText = '            func = func + ( [ (spl[1], 4)] )  #Result'."\r\n";
  fwrite($objFopen, $strText);
  $strText = '        elif spl[0] == "[D]" :'."\r\n";
  fwrite($objFopen, $strText);
  $strText = '            func = func + ( [ (spl[1] , 5)] ) #Discussion'."\r\n";
  fwrite($objFopen, $strText);
  $strText = "\r\n";
  fwrite($objFopen, $strText);
  $strText = 'random.shuffle(func)'."\r\n";
  fwrite($objFopen, $strText);
  $strText = 'x_featuresets = [(lexical_feature.lexical_feature(n)) for n,g in func]'."\r\n";
  fwrite($objFopen, $strText);
  $strText = 'y_featuresets = [result for n,result in func]'."\r\n";
  fwrite($objFopen, $strText);
  $strText = "\r\n";
  fwrite($objFopen, $strText);
  
  }elseif($feature == "grammar"){
  $strText = "func = []\r\n";
  fwrite($objFopen, $strText);
  $strText = "countSent = 0\r\n";
  fwrite($objFopen, $strText);
  $strText = "pos = ".'" "'."\r\n";
  fwrite($objFopen, $strText);
  $strText = "for i in range(1,61):\r\n";
  fwrite($objFopen, $strText);
  $strText = "    read1 = ".'"textUpload/bio%d"%(i)'."\r\n";
  fwrite($objFopen, $strText);
  $strText = "    read2 = ".'".txt"'."\r\n";
  fwrite($objFopen, $strText);
  $strText = "    read3 = read1 + read2\r\n";
  fwrite($objFopen, $strText);
  $strText = "    fileText = open(read3).read()\r\n";
  fwrite($objFopen, $strText);
  $strText = "    sentT = nltk.sent_tokenize(fileText)\r\n";
  fwrite($objFopen, $strText);
  $strText = "    lenS = float(len(sentT))/float(2)\r\n";
  fwrite($objFopen, $strText);
  $strText = "    countSent = countSent + (len(sentT))\r\n";
  fwrite($objFopen, $strText);
  $strText = "    for i,sent in enumerate(sentT):\r\n";
  fwrite($objFopen, $strText);
  $strText = "        if i < 2 :\r\n";
  fwrite($objFopen, $strText);
  $strText = "            pos = 1       #First\r\n";
  fwrite($objFopen, $strText);
  $strText = "        elif i >= len(sentT)-2 :\r\n";
  fwrite($objFopen, $strText);
  $strText = "            pos = 2       #Last\r\n";
  fwrite($objFopen, $strText);
  $strText = "        else :\r\n";
  fwrite($objFopen, $strText);
  $strText = "            pos = 3       #Ignore\r\n";
  fwrite($objFopen, $strText);
  $strText = "        spl = sent.split(".'"->")'."\r\n";
  fwrite($objFopen, $strText);
  $strText = "        if spl[0] == ".'"[B]" :'."\r\n";
  fwrite($objFopen, $strText);
  $strText = "            func = func + ( [ (spl[1], 1, pos)] ) #Background\r\n";
  fwrite($objFopen, $strText);
  $strText = "        elif spl[0] == ".'"[P]" :'."\r\n";
  fwrite($objFopen, $strText);
  $strText = "            func = func + ( [ (spl[1] , 2, pos)] )   #Purpose\r\n";
  fwrite($objFopen, $strText);
  $strText = "        elif spl[0] == ".'"[M]" :'."\r\n";
  fwrite($objFopen, $strText);
  $strText = "            func = func + ( [ (spl[1], 3, pos)] )     #Method\r\n";
  fwrite($objFopen, $strText);
  $strText = "        elif spl[0] == ".'"[R]" :'."\r\n";
  fwrite($objFopen, $strText);
  $strText = "            func = func + ( [ (spl[1], 4, pos)] )     #Result\r\n";
  fwrite($objFopen, $strText);
  $strText = "        elif spl[0] == ".'"[D]" :'."\r\n";
  fwrite($objFopen, $strText);
  $strText = "            func = func + ( [ (spl[1] , 5, pos)] )#Discussion\r\n";
  fwrite($objFopen, $strText);
  $strText = "random.shuffle(func)\r\n";
  fwrite($objFopen, $strText);
  $strText = "x_featuresets = [(grammar_feature.grammar_feature(n,p)) for n,g,p in func]\r\n";
  fwrite($objFopen, $strText);
  $strText = "y_featuresets = [result for n,result,p in func]\r\n";
  fwrite($objFopen, $strText);
  }else{
  $strText = "list_sentence = list()\r\n";
  fwrite($objFopen, $strText);
  $strText = "path = 'textUpload/bio'\r\n";
  fwrite($objFopen, $strText);
  $strText = "for index in range(1,61):\r\n";
  fwrite($objFopen, $strText);
  $strText = "    nameFile = path+str(index)+'.txt'\r\n";
  fwrite($objFopen, $strText);
  $strText = "    readAbs = open(nameFile).read()\r\n";
  fwrite($objFopen, $strText);
  $strText = "    sent_tokenize = nltk.sent_tokenize(readAbs)\r\n";
  fwrite($objFopen, $strText);
  $strText = "    move_before = 0   #first\r\n";
  fwrite($objFopen, $strText);
  $strText = "    for sent in sent_tokenize :\r\n";
  fwrite($objFopen, $strText);
  $strText = "        move_sent = sent.split('->')\r\n";
  fwrite($objFopen, $strText);
  $strText = "        move      = move_sent[0]\r\n";
  fwrite($objFopen, $strText);
  $strText = "        sentence  = move_sent[1]\r\n";
  fwrite($objFopen, $strText);
  $strText = "        if   move == ".'"[B]" :'."\r\n";
  fwrite($objFopen, $strText);
  $strText = "            move = 1        #Background\r\n";
  fwrite($objFopen, $strText);
  $strText = "        elif move == ".'"[P]" :'."\r\n";
  fwrite($objFopen, $strText);
  $strText = "            move = 2        #Purpose\r\n";
  fwrite($objFopen, $strText);
  $strText = "        elif move == ".'"[M]" :'."\r\n";
  fwrite($objFopen, $strText);
  $strText = "            move = 3        #Method\r\n";
  fwrite($objFopen, $strText);
  $strText = "        elif move == ".'"[R]" :'."\r\n";
  fwrite($objFopen, $strText);
  $strText = "            move = 4        #Result\r\n";
  fwrite($objFopen, $strText);
  $strText = "        else :\r\n";
  fwrite($objFopen, $strText);
  $strText = "            move = 5        #Discussion\r\n";
  fwrite($objFopen, $strText);
  $strText = "\r\n";
  fwrite($objFopen, $strText);
  $strText = "        list_sentence.append((sentence,move_before,move))\r\n";
  fwrite($objFopen, $strText);
  $strText = "        move_before = move\r\n";
  fwrite($objFopen, $strText);
  $strText = "\r\n";
  fwrite($objFopen, $strText);
  $strText = "random.shuffle(list_sentence)\r\n";
  fwrite($objFopen, $strText);
  $strText = "x_featuresets = [ (lexical_grammar_feature.lexical_grammar_feature(s,b)) for s,b,m in list_sentence]\r\n";
  fwrite($objFopen, $strText);
  $strText = "y_featuresets = [result for s,b,result in list_sentence]\r\n";
  fwrite($objFopen, $strText);
  $strText = "\r\n";
  fwrite($objFopen, $strText);
  }

  
  $strText = 'x_train, x_test, y_train, y_test = train_test_split(x_featuresets, y_featuresets, test_size=0.2, random_state=0)'."\r\n";
  fwrite($objFopen, $strText);

  if($model == "svm"){
  	$strText = "classifier = svm.SVC(gamma='scale', decision_function_shape='ovo')\r\n";
  	fwrite($objFopen, $strText);
    $strText = "classifier = classifier.fit(x_train, y_train)\r\n";
    fwrite($objFopen, $strText);
    $strText = "y_pred = classifier.predict(x_test)\r\n";
    fwrite($objFopen, $strText);
    $strText = "\r\n";
  fwrite($objFopen, $strText);
  }elseif($model == "tree"){
  	$strText = "classifier = tree.DecisionTreeClassifier()\r\n";
  	fwrite($objFopen, $strText);
    $strText = "classifier = classifier.fit(x_train, y_train)\r\n";
    fwrite($objFopen, $strText);
    $strText = "y_pred = classifier.predict(x_test)\r\n";
    fwrite($objFopen, $strText);
    $strText = "\r\n";
  fwrite($objFopen, $strText);
  }elseif($model == "GaussianNB"){
  	$strText = "classifier = GaussianNB()\r\n";
  	fwrite($objFopen, $strText);
    $strText = "classifier = classifier.fit(x_train, y_train)\r\n";
    fwrite($objFopen, $strText);
    $strText = "y_pred = classifier.predict(x_test)\r\n";
    fwrite($objFopen, $strText);
    $strText = "\r\n";
    fwrite($objFopen, $strText);
  }else{
  	$strText = "classifier = RandomForestClassifier(n_estimators=1000, random_state=0)\r\n";
  	fwrite($objFopen, $strText);
    $strText = "classifier = classifier.fit(x_train, y_train)\r\n";
    fwrite($objFopen, $strText);
    $strText = "y_pred = classifier.predict(x_test)\r\n";
    fwrite($objFopen, $strText);
    $strText = "\r\n";
    fwrite($objFopen, $strText);
  }

  $strText = "with open('".$feature."_textclassifier_".$model."_".$field.".pickle','wb') as picklefile:"."\r\n";
  fwrite($objFopen, $strText);
  $strText = "    pickle.dump(classifier,picklefile)"."\r\n";
  fwrite($objFopen, $strText);
  $strText = "\r\n";
  fwrite($objFopen, $strText);
 
  $strText = "confustion = confusion_matrix(y_test,y_pred)"."\r\n";
  fwrite($objFopen, $strText);
  $strText = "accuracy = accuracy_score(y_test, y_pred)"."\r\n";
  fwrite($objFopen, $strText);
  $strText = "classification_report = classification_report(y_test,y_pred)"."\r\n";
  fwrite($objFopen, $strText);
  $strText = "\r\n";
  fwrite($objFopen, $strText);
  $strText = 'fOut = "report/report_'.$feature."_".$model."_".$field.'.txt"'."\r\n";
  fwrite($objFopen, $strText);
  $strText = 'fh = open(fOut,"w")'."\r\n";
  fwrite($objFopen, $strText);
  $strText = "\r\n";
  fwrite($objFopen, $strText);
  $strText = 'str_confustion = str(confustion)'."\r\n";
  fwrite($objFopen, $strText);
  $strText = 'str_accuracy = str(accuracy)'."\r\n";
  fwrite($objFopen, $strText);
  $strText = 'str_classification_report = str(classification_report)'."\r\n";
  fwrite($objFopen, $strText);
  $strText = "\r\n";
  fwrite($objFopen, $strText);
  $strText = "fh.writelines('Confusion matrix : ".'\n'."')"."\r\n";
  fwrite($objFopen, $strText);
  $strText = "fh.writelines(str_confustion+'".'\n\n'."')"."\r\n";
  fwrite($objFopen, $strText);
  $strText = "fh.writelines('Accuracy : ".'\n'."')"."\r\n";
  fwrite($objFopen, $strText);
  $strText = "fh.writelines(str_accuracy+'".'\n\n'."')"."\r\n";
  fwrite($objFopen, $strText);
  $strText = "fh.writelines('Classification report : ".'\n'."')"."\r\n";
  fwrite($objFopen, $strText);
  $strText = "fh.writelines(str_classification_report+'".'\n'."')"."\r\n";
  fwrite($objFopen, $strText);
  $strText = "fh.close()"."\r\n";
  fwrite($objFopen, $strText);

  if($objFopen){
  	echo "File writed.";
  } else {
  	echo "File can't write.";
  }
  fclose($objFopen);
}

#createPyTrainPickle("lexicalgrammar","GaussianNB","bm");
?>