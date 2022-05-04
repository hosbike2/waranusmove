#!/usr/bin/python
import re
import nltk
import collections
import operator
import random
import numpy as np
from collections import defaultdict
from nltk.stem import WordNetLemmatizer
wnl = WordNetLemmatizer()
from nltk import bigrams
from nltk.corpus import wordnet as wn
from nltk.corpus import stopwords
stop_word = stopwords.words('english')
mov_ = ['background','purpose','method','result','discussion']
def stem(w,t):
    if len(w) > 2 and w.isalpha() and w not in ['for','not','been','be','was','were','is','am','are','have','has'] and t not in ['DT','TO','AT','CC','CD','MD']:
        if t.startswith('NN') :
            return wnl.lemmatize(w.lower()) or w
        elif t.startswith('VB'):
            return wn.morphy(w,wn.VERB) or wn.morphy(w) or w
        elif t == 'RB' :
            return  wn.morphy(w,wn.VERB) or wnl.lemmatize(w.lower()) or w
        elif t == 'JJ' :
            return wn.morphy(w,wn.VERB) or wn.morphy(w) or w
        else :
            return wn.morphy(w) or w
    else : return w
#------------------------------------------------------------------------------
def stem_freq(w,t):
    if len(w) > 2 and w.isalpha() and w not in ['for','not','been','be','was','were','is','am','are','have','has'] and t not in ['DT','TO','AT','CC','CD','MD']:
        if t.startswith('NN') :
            return wn.morphy(w,wn.VERB) or wnl.lemmatize(w) or w
        elif t.startswith('VB'):
            return wn.morphy(w,wn.VERB) or wn.morphy(w) or w
        elif t == 'RB' :
            return  wn.morphy(w,wn.VERB) or wnl.lemmatize(w) or w
        elif t == 'JJ' :
            return wn.morphy(w,wn.VERB) or wn.morphy(w) or w
        else :
            return wn.morphy(w) or w



#Count Frequency
def countFreq():
    background = []
    purpose = []
    method = []
    result = []
    discussion = []

    N = 0
    for i in range(1,61):
        fileText = open('/TextBiomedical/bio'+str(i)+'.txt').read()
        sents =    nltk.sent_tokenize(fileText.strip())
        N = N + len(sents)
        for sent in sents:
            snt = sent.split("->")
            snt_list = nltk.word_tokenize(snt[1])
            if snt[0] == "[B]" :
                background.append(snt_list)
            elif snt[0] == "[P]" :
                purpose.append(snt_list)
            elif snt[0] == "[M]" :
                method.append(snt_list)
            elif snt[0] == "[R]" :
                result.append(snt_list)
            elif snt[0] == "[D]" :
                discussion.append(snt_list)
    word_all = [[],[],[],[],[]]
    sents_all = [background,purpose,method,result,discussion]
    sents_tagged = [[],[],[],[],[]]
    for i,sents in enumerate(sents_all):
        for sent in sents:
            tagged = nltk.pos_tag(sent)
            sents_tagged[i].append(tagged)
            for word,tag in tagged:
                word_all[i].append((word.lower(),tag))

    freq_dic = [{},{},{},{},{}]
    freq_tagged = [{},{},{},{},{}]
    def count_word(word_move):
        for w,t in sorted(word_move):
            st = stem_freq(w,t)
            if st != None:
                try:
                    freq_dic[i][st] += 1
                except:
                    freq_dic[i][st] = 1
                try:
                    freq_tagged[i][st,t] += 1
                except:
                    freq_tagged[i][st,t] = 1
                    
    for i,word_move in enumerate(word_all):
        count_word(word_move)

    for i,word_move in enumerate(word_all):
        freq = operator.itemgetter(1) 
        file_word = open('freq_word/freq_'+mov_[i]+'.txt',"w")        
        for k, v in sorted(freq_dic[i].items(), reverse=True, key=freq):
            count = 0
            for n in freq_dic:
                if n.has_key(k):
                    count+=1
            if v > 2 and count < 3 and len(k) > 2:
                file_word.write( "%d %s\n" % (v, k))
        file_word.close()
        file_word1 = open('freq_word/tagged_'+mov_[i]+'.txt',"w")        
        for (w,t), v in sorted(freq_tagged[i].items(), reverse=True, key=freq):
            count = 0
            for n in freq_tagged:
                if n.has_key((w,t)):
                    count+=1
            if v > 2 and count < 3 and len(w) > 2:
                file_word1.write( "%d %s\n" % (v,w+'_'+t))
        file_word1.close()
    freq_bg = [{},{},{},{},{}]
    def count_bigram(sents,m):
        for sent in sents:
            nsent = []
            for w,t in sent:
                if w.isalpha() :
                    ws = stem_freq(w.lower(),t)
                    if ( ws == None or len(ws)==1 ) :
                        ws = w.lower()
                    elif w.isupper():
                        ws = w
                    nsent.append(ws)
            def ngrams(words, n=2, padding=False):
                pad = [] if not padding else [None]*(n-1)
                grams = pad + words + pad
                return (tuple(grams[i:i+n]) for i in range(0, len(grams) - (n - 1)))
                #print list(ngrams(sent, 2, 1)
            for ng1,ng2 in ngrams(nsent, 2, False):
                if not((len(ng1)<3 and len(ng2)<3) or ( ng1.isupper() or ng2.isupper())):
                    try:
                        freq_bg[m][ng1,ng2] += 1
                    except:
                        freq_bg[m][ng1,ng2] = 1


    for i,sents_move in enumerate(sents_tagged):
        count_bigram(sents_move,i)
        
    for i,sents_move in enumerate(sents_tagged):
        freq = operator.itemgetter(1)
        file_word = open('freq_word/bigram_'+mov_[i]+'.txt',"w")
        for (ng1,ng2), c in sorted(freq_bg[i].items(), reverse=True, key=freq):
            count = 0
            for n in freq_bg:
                if n.has_key((ng1,ng2)):
                    count+=1
            if c > 1 and count < 2 :
                file_word.write( "%d %s  %s\n" % (c, ng1,ng2))
        file_word.close()

#------------------------------------------------------------------------------
#Corpus
import corpus
def word_corpus(sent):
    score = [0,0,0,0,0]
    for w in sent:
        if w.lower() in corpus.vword_b:
            score[0] +=1
        if w.lower() in corpus.vword_p:
            score[1]+=1
        if w.lower() in corpus.vword_m:
            score[2]=1
        if w.lower() in corpus.vword_r:
            score[3]+=1
        if w.lower() in corpus.vword_d:
            score[4]+=1
    if max(score) == 0:
        return 0
    else :
        return score.index(max(score))+1



def ngram(sent):
    score = [0,0,0,0,0]
    for ng in corpus.ngram_b:
        if ng in sent:
            score[0] +=1
    for ng in corpus.ngram_p:
        if ng in sent:
            score[1] +=1
    for ng in corpus.ngram_m:
        if ng in sent:
            score[2] +=1
    for ng in corpus.ngram_r:
        if ng in sent:
            score[3] +=1
    for ng in corpus.ngram_d:
        if ng in sent:
            score[4] +=1
    if max(score) == 0:
        return 0
    else :
        return score.index(max(score))+1

def expression(sent):
    #sent = ' '.join(sent)
    score = [0,0,0,0,0]
    for ng in corpus.ex_b:
        if ng in sent:
            score[0] +=1
    for ng in corpus.ex_p:
        if ng in sent:
            score[1] +=1
    for ng in corpus.ex_m:
        if ng in sent:
            score[2] +=1
    for ng in corpus.ex_r:
        if ng in sent:
            score[3] +=1
    for ng in corpus.ex_d:
        if ng in sent:
            score[4] +=1
    if max(score) == 0:
        return 0
    else :
        return score.index(max(score))+1

def collocation(sent):
    score = [0,0,0,0,0]
    for w1,w2 in corpus.cl_b:
        re_ = ".*"+w1+".*"+w2
        if re.match(re_,sent):
            #print sent
            #print w1,w2
            score[0] +=1
    for w1,w2 in corpus.cl_p:
        re_ = ".*"+w1+".*"+w2
        if re.match(re_,sent):
            #print sent
            #print w1,w2
            score[1] +=1
    for w1,w2 in corpus.cl_m:
        re_ = ".*"+w1+".*"+w2
        if re.match(re_,sent):
            #print sent
            #print w1,w2
            score[2] +=1
    for w1,w2 in corpus.cl_r:
        re_ = ".*"+w1+".*"+w2
        if re.match(re_,sent):
            #print sent
            #print w1,w2
            score[3] +=1
    for w1,w2 in corpus.cl_d:
        re_ = ".*"+w1+".*"+w2
        if re.match(re_,sent):
            #print sent
            #print w1,w2
            score[4] +=1
    if max(score) == 0:
        return 0
    else :
        return score.index(max(score))+1
                   
#--------------------------------------------------------------------------------

def word_(sent):
    score = [0,0,0,0,0]
    score_sent = [0,0,0,0,0]
    for word in sent:
            if word in corpus.word_b:
                index = corpus.word_b.index(word)
                score[0] = int(corpus.word_b1[index][0])
            if word in corpus.word_p:
                index = corpus.word_p.index(word)
                score[1] = int(corpus.word_p1[index][0])
            if word in corpus.word_m:
                index = corpus.word_m.index(word)
                score[2] = int(corpus.word_m1[index][0])
            if word in corpus.word_r:
                index = corpus.word_r.index(word)
                score[3] = int(corpus.word_r1[index][0])
            if word in corpus.word_d:
                index = corpus.word_d.index(word)
                score[4] = int(corpus.word_d1[index][0])
            i = score.index(max(score))
            if score[i] !=0:
                score_sent[i] += 1
            score = [0,0,0,0,0]
    if max(score_sent) == 0:
        return 0
    else :
        return score_sent.index(max(score_sent))+1

def tag_(sent):
    score = [0,0,0,0,0]
    score_sent = [0,0,0,0,0]
    for word,tag in sent:
        if word not in stop_word :
            w = str(stem(word.lower(),tag))+'_'+tag
            if w in corpus.tagged_b:
                index = corpus.tagged_b.index(w)
                score[0] = int(corpus.tagged_b1[index][0])
            if w in corpus.tagged_p:
                index = corpus.tagged_p.index(w)
                score[1] = int(corpus.tagged_p1[index][0])
            if w in corpus.tagged_m:
                index = corpus.tagged_m.index(w)
                score[2] = int(corpus.tagged_m1[index][0])
            if w in corpus.tagged_r:
                index = corpus.tagged_r.index(w)
                score[3] = int(corpus.tagged_r1[index][0])
            if w in corpus.tagged_d:
                index = corpus.tagged_d.index(w)
                score[4] = int(corpus.tagged_d1[index][0])
            i = score.index(max(score))
            if score[i] !=0:
                score_sent[i] += 1
            score = [0,0,0,0,0]
    if max(score_sent) == 0:
        return 0
    else :
        return score_sent.index(max(score_sent))+1

def bigram_(sent):
    bigram_list = list(bigrams(sent))
    score = [0,0,0,0,0]
    score_sent = [0,0,0,0,0]
    for bigram in bigram_list:
        if bigram in corpus.bigram_b:
            index = corpus.bigram_b.index(bigram)
            score[0] = int(corpus.bigram_b1[index][0])
        if bigram in corpus.bigram_p:
            index = corpus.bigram_p.index(bigram)
            score[1] = int(corpus.bigram_p1[index][0])
        if bigram in corpus.bigram_m:
            index = corpus.bigram_m.index(bigram)
            score[2] = int(corpus.bigram_m1[index][0])
        if bigram in corpus.bigram_r:
            index = corpus.bigram_r.index(bigram)
            score[3] = int(corpus.bigram_r1[index][0])
        if bigram in corpus.bigram_d:
            index = corpus.bigram_d.index(bigram)
            score[4] = int(corpus.bigram_d1[index][0])
        i = score.index(max(score))
        if score[i] !=0:
                score_sent[i] += 1
        score = [0,0,0,0,0]
    if max(score_sent) == 0:
        return 0
    else :
        return score_sent.index(max(score_sent))+1

   
def lexical_feature(sent_):
    sent = nltk.word_tokenize(sent_)
    tagged_sent = nltk.pos_tag(sent)
    stem_list = [stem(w.lower(),t) for w,t in tagged_sent]
    stem_sent = ' '.join([stem(w.lower(),t) for w,t in tagged_sent])
    features = [0,0,0,0,0,0,0]
    #word_corpus
    features[0] = word_corpus(stem_list)
    #n-gram
    features[1] = ngram(stem_sent)
    #expression
    features[2] = expression(sent_)
    #collocation
    features[3] = collocation(stem_sent)
    #word
    features[4] = word_(stem_list)
    #tag
    features[5] = tag_(tagged_sent)
    #bigram
    features[6] = bigram_(stem_list)
    return features

#countFreq()
