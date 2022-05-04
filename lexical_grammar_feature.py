import os
import nltk
import re
import corpus
from nltk.stem import WordNetLemmatizer
wnl = WordNetLemmatizer()
from nltk import bigrams
from nltk.corpus import wordnet as wn
from nltk.corpus import stopwords

stop_word = stopwords.words('english')
symbol = ['.',',',';','\"',"\'",'?','(',')',':','-','_','`','$','?','...','[',']','=','<','>']
stem_word = ['for','not','been','be','was','were','is','am','are','have','has']
stem_tag  = ['DT','TO','AT','CC','CD','MD']

def stem(w,t):
    
    if len(w) > 2 and w.isalpha() and w not in stem_word and t not in stem_tag:
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
    else : return w
    
def lexical_grammar_feature(sentence,move):
    
    features        = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]
    sentence_tag    = str()
    
    tense           = 1          
    voice           = 1        
    extraposition   = 0 #False
    norminalizing   = 0 #False
    modal           = 0 #False
    pronoun         = 0 #False
    toinf           = 0 #False
    in_order        = 0 #False
    whether         = 0 #False
    by              = 0 #False
    ving            = 0 #False
    article         = 0 #False
    the             = 0 #False
    prep            = 0 #False
    move_before     = move #เป็นตัวเลขมาอยู่แล้ว

    word_corpus     = 0
    ngram           = 0
    expression      = 0
    collocation     = 0
    frequency_word  = 0
    frequency_tag   = 0
    frequency_bigram= 0
    
    

    list_word = [ w.lower() for w in nltk.word_tokenize(sentence)]
    tagged  = nltk.pos_tag(list_word)
    for w,t in tagged:
        sentence_tag += w+"/"+t+" "
    word = [ w  for w in list_word if w not in symbol ]
    bigram = nltk.bigrams(word)
    list_bigram = [ i+" "+j for (i,j) in bigram ]
    list_wordtag = [ w+"_"+t for w,t in tagged]
    list_search = word + list_bigram + list_wordtag
    stem_list = [stem(w,t) for w,t in tagged]
    stem_sent = ' '.join([stem(w,t) for w,t in tagged])

#######################################################################
# word corpus

    score = [0,0,0,0,0]
    for w in stem_list :
        if w in corpus.word_b:
            score[0] +=1
        if w in corpus.word_p:
            score[1] +=1
        if w in corpus.word_m:
            score[2] +=1
        if w in corpus.word_r:
            score[3] +=1
        if w in corpus.word_d:
            score[4] +=1
    if max(score) == 0:
         word_corpus = 0
    else :
         word_corpus = score.index(max(score))+1
    
#######################################################################
# n-grams

    score = [0,0,0,0,0]
    for w in corpus.ngram_b:
        if w in stem_sent:
            score[0] +=1
    for w in corpus.ngram_p:
        if w in stem_sent:
            score[1] +=1
    for w in corpus.ngram_m:
        if w in stem_sent:
            score[2] +=1
    for w in corpus.ngram_r:
        if w in stem_sent:
            score[3] +=1
    for w in corpus.ngram_d:
        if w in stem_sent:
            score[4] +=1
    if max(score) == 0:
        ngram = 0
    else :
        ngram = score.index(max(score))+1
        
#######################################################################
# Expression
    
    score = [0,0,0,0,0]
    for w in corpus.ex_b:
        if w in sentence:
            score[0] +=1
    for w in corpus.ex_p:
        if w in sentence:
            score[1] +=1
    for w in corpus.ex_m:
        if w in sentence:
            score[2] +=1
    for w in corpus.ex_r:
        if w in sentence:
            score[3] +=1
    for w in corpus.ex_d:
        if w in sentence:
            score[4] +=1
    if max(score) == 0:
        expression = 0
    else :
        expression = score.index(max(score))+1
        
#######################################################################
# Collocation

    score = [0,0,0,0,0]
    for w1,w2 in corpus.cl_b:
        pattern = ".*"+w1+".*"+w2
        if re.match(pattern,stem_sent):
            #print sent
            #print w1,w2
            score[0] +=1
    for w1,w2 in corpus.cl_p:
        pattern = ".*"+w1+".*"+w2
        if re.match(pattern,stem_sent):
            #print sent
            #print w1,w2
            score[1] +=1
    for w1,w2 in corpus.cl_m:
        pattern = ".*"+w1+".*"+w2
        if re.match(pattern,stem_sent):
            #print sent
            #print w1,w2
            score[2] +=1
    for w1,w2 in corpus.cl_r:
        pattern = ".*"+w1+".*"+w2
        if re.match(pattern,stem_sent):
            #print sent
            #print w1,w2
            score[3] +=1
    for w1,w2 in corpus.cl_d:
        pattern = ".*"+w1+".*"+w2
        if re.match(pattern,stem_sent):
            #print sent
            #print w1,w2
            score[4] +=1
    if max(score) == 0:
        collocation = 0
    else :
        collocation = score.index(max(score))+1
        
#######################################################################
# frequency word

    
    score_sent = [0,0,0,0,0]
    for w in stem_list:
        score = [0,0,0,0,0]
        
        if w in corpus.word_b:
            index = corpus.word_b.index(w)
            score[0] = int(corpus.word_b1[index][0])
        if w in corpus.word_p:
            index = corpus.word_p.index(w)
            score[1] = int(corpus.word_p1[index][0])
        if w in corpus.word_m:
            index = corpus.word_m.index(w)
            score[2] = int(corpus.word_m1[index][0])
        if w in corpus.word_r:
            index = corpus.word_r.index(w)
            score[3] = int(corpus.word_r1[index][0])
        if w in corpus.word_d:
            index = corpus.word_d.index(w)
            score[4] = int(corpus.word_d1[index][0])
        i = score.index(max(score))
        if score[i] !=0:
            score_sent[i] += 1
        
    if max(score_sent) == 0:
        frequency_word = 0
    else :
        frequency_word = score_sent.index(max(score_sent))+1
    
#######################################################################
# frequency tag

    score_sent = [0,0,0,0,0]
    for w,t in tagged:
        if w not in stop_word :
            score = [0,0,0,0,0]
            word_tag = str(stem(w,t))+'_'+t
            if word_tag in corpus.tagged_b:
                index = corpus.tagged_b.index(word_tag)
                score[0] = int(corpus.tagged_b1[index][0])
            if word_tag in corpus.tagged_p:
                index = corpus.tagged_p.index(word_tag)
                score[1] = int(corpus.tagged_p1[index][0])
            if word_tag in corpus.tagged_m:
                index = corpus.tagged_m.index(word_tag)
                score[2] = int(corpus.tagged_m1[index][0])
            if word_tag in corpus.tagged_r:
                index = corpus.tagged_r.index(word_tag)
                score[3] = int(corpus.tagged_r1[index][0])
            if word_tag in corpus.tagged_d:
                index = corpus.tagged_d.index(word_tag)
                score[4] = int(corpus.tagged_d1[index][0])
            i = score.index(max(score))
            if score[i] !=0:
                score_sent[i] += 1
            
    if max(score_sent) == 0:
        frequency_tag = 0
    else :
        frequency_tag = score_sent.index(max(score_sent))+1
#######################################################################
# frequency bigram

    bigram_list = list(bigrams(stem_list))
    score = [0,0,0,0,0]
    score_sent = [0,0,0,0,0]
    for bi  in bigram_list:
        if bi in corpus.bigram_b:
            index = corpus.bigram_b.index(bi)
            score[0] = int(corpus.bigram_b1[index][0])
        if bi in corpus.bigram_p:
            index = corpus.bigram_p.index(bi)
            score[1] = int(corpus.bigram_p1[index][0])
        if bi in corpus.bigram_m:
            index = corpus.bigram_m.index(bi)
            score[2] = int(corpus.bigram_m1[index][0])
        if bi in corpus.bigram_r:
            index = corpus.bigram_r.index(bi)
            score[3] = int(corpus.bigram_r1[index][0])
        if bi in corpus.bigram_d:
            index = corpus.bigram_d.index(bi)
            score[4] = int(corpus.bigram_d1[index][0])
        i = score.index(max(score))
        if score[i] !=0:
                score_sent[i] += 1
        score = [0,0,0,0,0]
    if max(score_sent) == 0:
        frequency_bigram = 0
    else :
        frequency_bigram = score_sent.index(max(score_sent))+1                   

#######################################################################
# To
    score = [0,0,0,0,0]
    if re.match(r'.*(\bto\b).*',sentence_tag):
        for l in list_word:
           if l in corpus.to_b :
               score[0] += 1
           if l in corpus.to_p :
               score[1] += 1
           if l in corpus.to_m :
               score[2] += 1
           if l in corpus.to_r :
               score[3] += 1
           if l in corpus.to_d :
               score[4] += 1
    
    if max(score) == 0:
        to = 0
    else :
        to = score.index(max(score))+1


#######################################################################
# We
    score = [0,0,0,0,0]
    if re.match(r'.*(\bwe\b).*',sentence_tag):
        for l in list_word:
           if l in corpus.we_b :
               score[0] += 1
           if l in corpus.we_p :
               score[1] += 1
           if l in corpus.we_m :
               score[2] += 1
           if l in corpus.we_r :
               score[3] += 1
           if l in corpus.we_d :
               score[4] += 1
    if max(score) == 0:
        we = 0
    else :
        we = score.index(max(score))+1


#######################################################################################################################
# This
    score = [0,0,0,0,0]
    if re.match(r'.*(\bthis\b).*',sentence_tag):
        for l in list_word:
           if l in corpus.this_b :
               score[0] += 1
           if l in corpus.this_p :
               score[1] += 1
           if l in corpus.this_m :
               score[2] += 1
           if l in corpus.this_r :
               score[3] += 1
           if l in corpus.this_d :
               score[4] += 1
    if max(score) == 0:
        this = 0
    else :
        this = score.index(max(score))+1

#######################################################################################################################
# Active - Passive and Tense

 #Present Tense
    if re.match(r'.*(\bhas\b|\bhave\b).*\bbeen\b.*\bVBN\b',sentence_tag) :
        tc = "Present Perfect 2"
        #print re.findall(r'.*(\bhas\b|\bhave\b).*\bbeen\b.*\bVBN\b',str)
        tense = 1
        voice = 2
    elif re.match(r'.*(\bhas\b|\bhave\b).*\bbeen\b.*\bbeing\b.*\bVBN\b',sentence_tag) :
        tc = "Present Perfect Continuous 2"
        #print re.findall(r'.*(\bhas\b|\bhave\b).*\bbeen\b.*\bbeing\b.*\bVBN\b',str)
        tense = 1
        voice = 2
    elif re.match(r'.*(\bhas\b|\bhave\b).*\bbeen\b.*\bVBG\b',sentence_tag) :
        tc = "Present Perfect Continuous 1"
        #print re.findall(r'.*(\bhas\b|\bhave\b|\bve\b).*\bbeen\b.*\bVBG\b',str)
        tense = 1
        voice = 1
    elif re.match(r'.*(\bhas\b|\bhave\b).*\bVBN\b',sentence_tag) :
        tc = "Present Perfect 1"
        #print re.findall(r'.*(\bhas\b|\bhave\b).*\bVBN\b',str)
        tense = 1
        voice = 1
    elif re.match(r'.*(\bis\b|\bam\b|\bare\b).*\bbeing\b.*\bVBN\b',sentence_tag) :
        tc = "Present Continuous 2"
        #print re.findall(r'.*(\bis\b|\bam\b|\bare\b).*\bbeing\b.*\bVBN\b',str)
        tense = 1
        voice = 2
    elif re.match(r'.*(\bis\b|\bam\b|\bare\b).*\bVBN\b',sentence_tag) :
        tc = "Present Simple 2"
        #print re.findall(r'.*(\bis\b|\bam\b|\bare\b).*\bVBN\b',str) 
        tense = 1
        voice = 2
    elif re.match(r'.*(\bVBZ\b|\bVBP\b|\bVB\b)',sentence_tag) :
        tc = "Present Simple 1"
        #print re.findall(r'.*(\bVB\b|\bVBP\b|\bVB\b)',str) 
        tense = 1
        voice = 1
    elif re.match(r'.*(\bis\b|\bam\b|\bare\b).*\bVBG\b',sentence_tag) :
        tc = "Present Continuous 1"
        #print re.findall(r'.*(\bis\b|\bam\b|\bare\b).*\bVBG\b',str)
        tense = 1
        voice = 1
    
        

    #Past Tense
    if re.match(r'.*\bhad\b.*\bbeen\b.*\bbeing\b.*\bVBN\b',sentence_tag) :
        tc = "Past Perfect Continuous 2"
        #print re.findall(r'.*\bhad\b.*\bbeen\b.*\bbeing\b.*\bVBN\b',str)
        tense = 2
        voice = 2
        
    elif re.match(r'.*\bhad\b.*\bbeen\b.*\bVBG\b',sentence_tag) :
        tc = "Past Perfect Continuous 1"
        #print re.findall(r'.*\bhad\b.*\bVBN\b.*\bVBG\b',str)
        tense = 2
        voice = 1
    
    elif re.match(r'.*\bhad\b.*\bVBN\b',sentence_tag) :
        tc = "Past Perfect 1"
        #print re.findall(r'.*\bhad\b.*\bVBN\b',str)
        tense = 2
        voice = 1
    
    elif re.match(r'.*\bhad\b.*\bbeen\b.*\bVBN\b',sentence_tag) :
        tc = "Past Perfect 2"
        #print re.findall(r'.*\bhad\b.*\bbeen\b.*\bVBN\b',str)
        tense = 2
        voice = 2
    elif re.match(r'.*(\bwas\b|\bwere\b).*\bVBN\b',sentence_tag) :
        tc = "Past Simple 2"
        #print re.findall(r'.*(\bwas\b|\bwere\b).*\bVBN\b',str) 
        tense = 2
        voice = 2
    elif re.match(r'.*\bVBD\b',sentence_tag) :
        tc = "Past Simple 1"
        #print re.findall(r'.*\bVBD\b',str)
        tense = 2
        voice = 1
    elif re.match(r'.*(\bwas\b|\bwere\b).*\bVBG\b',sentence_tag) :
        tc = "Past Continuous 1"
        #print re.findall(r'.*(\bwas\b|\bwere\b).*\bVBG\b',str)
        tense = 2
        voice = 1
    elif re.match(r'.*(\bwas\b|\bwere\b).*\bbeing\b.*\bVBN\b',sentence_tag) :
        tc = "Past Continuous 2"
        #print re.findall(r'.*(\bwas\b|\bwere\b).*\bbeing\b.*\bVBN\b',str)
        tense = 2
        voice = 2
        

    #Future Tense    
    if re.match(r'.*\bwill\b.*\bhave\b.*\bbeen\b.*\bbeing\b.*\bVBN\b',sentence_tag) :
        tc = "Future Perfect Continuous 2"
        #print re.findall(r'.*\bwill\b.*\bhave\b.*\bbeen\b.*\bbeing\b.*\bVBN\b',str)
        tense = 3
        voice = 2
    elif re.match(r'.*\bwill\b.*\bhave\b.*\bbeen\b.*\bVBG\b',sentence_tag) :
        tc = "Future Perfect Continuous 1"
        #print re.findall(r'.*\bwill\b.*\bhave\b.*\bbeen\b.*\bVBG\b',str)
        tense = 3
        voice = 1
    elif re.match(r'.*\bwill\b.*\bhave\b.*\bVBN\b',sentence_tag) :
        tc = "Future Perfect 1"
        #print re.findall(r'.*\bwill\b.*\bhave\b.*\bVBN\b',str)
        tense = 3
        voice = 1
    elif re.match(r'.*\bwill\b.*\bhave\b.*\bbeen\b.*\bVBN\b',sentence_tag) :
        tc = "Future Perfect 2"
        #print re.findall(r'.*\bwill\b.*\bhave\b.*\bbeen\b.*\bVBN\b',str)
        tense = 3
        voice = 2
    elif re.match(r'.*\bwill\b.*\bbe\b.*\bVBG\b',sentence_tag) :
        tc = "Future Continuous 1"
        #print re.findall(r'.*(\bwill\b).*\bbe\b.*\bVBG\b',str)
        tense = 3
        voice = 1
    elif re.match(r'.*\bwill\b.*\bbe\b.*\bbeing\b.*\bVBN\b',sentence_tag) :
        tc = "Future Continuous 2"
        #print re.findall(r'.*\bwill\b.*\bbe\b.*\bbeing\b.*\bVBN\b',str) 
        tense = 3
        voice = 2
    elif re.match(r'.*(\bwill\b|\bcan\b|\bcould\b|\bmay\b|\bcould\b).*\bbe\b.*\bVBN\b',sentence_tag) :
        tc = "Future Simple 2"
        #print re.findall(r'.*\bwill\b.*\bbe\b.*\bVBN\b',str)
        tense = 3
        voice = 2
    elif re.match(r'.*\bwill\b.*(\bVB\b|\bVBP\b)',sentence_tag) :
        tc = "Future Simple 1"
        #print re.findall(r'.*\bwill\b.*(\bVB\b|\bVBP\b)',str)
        tense = 3
        voice = 1
           
#######################################################################
# Extraposition
            
    if re.match(r'.*\bit\b.*(\bis\b|\bam\b|\bare\b|\bwas\b|\bwere\b).*\bthat\b',sentence_tag):
        extraposition = 1  #True
    elif re.match(r'.*\bit\b.*(\bis\b|\bam\b|\bare\b|\bwas\b|\bwere\b)',sentence_tag):
        extraposition = 1 #True
         
#######################################################################
# Norminalizing
        
    if re.match(r'.*\bthe\b.*\bof\b',sentence_tag):
        norminalizing = 1  #True
        
#######################################################################
# Modal
        
    if re.match(r'.*(\bwill\b|\bshall\b|\bcan\b|\bcould\b|\bmay\b|\bmight\b|\bwould\b|\bshould\b)',sentence_tag):
        modal = 1  #True
        
#######################################################################
# Pronoun
        
    if re.match(r'.*(\bwe\b|\bour\b|\bthis\b|\bthese\b)',sentence_tag):
        pronoun = 1  #True
        
#######################################################################################################################
# To 
    if re.match(r'.*(\bto\b).*(\bVB\b|\bVBZ\b|\bVBP\b)',sentence_tag):
        toinf = 1  #True
            
#######################################################################################################################
# In order to
    if re.match(r'.*\bin\b.*\border\b.*\bto\b',sentence_tag):
        in_order = 1  #True
            
#######################################################################################################################
# Whether
    if re.match(r'.*\bwhether\b',sentence_tag):
        whether = 1  #True
            
#######################################################################################################################
# ByING
    if re.match(r'.*\bby\b.*\bVBG\b',sentence_tag):
        by = 1  #True
             
#######################################################################################################################
# Verb ing
    if re.match(r'.*\bVBG\b',sentence_tag):
        ving = 1  #True
             
#######################################################################################################################       
# Article
    if re.match(r'.*(\bA\b|\bAn\b)',sentence_tag):
        article = 1  #True
             
#######################################################################################################################
# The
    if re.match(r'.*\bthe\b',sentence_tag):
        the = 1  #True
    
#######################################################################################################################
# Preposition

    if re.match(r'.*(\bin\b|\bover\b|\bbetween\b|\binto\b|\bat\b|\bfrom\b|\bby\b|\bfor\b|\bon\b|\bunder\b|\bthough\b|\bduring\b|\bamong\b)',sentence_tag):
        #print re.findall(r'.*(\bin\b|\bover\b|\bbetween\b|\binto\b|\bat\b|\bfrom\b|\bby\b|\bfor\b|\bon\b|\bunder\b|\bthough\b|\bduring\b|\bamong\b)',str)
        prep = 1  #True

#######################################################################################################################      

    features[0]     = word_corpus      #word_corpus
    features[1]     = ngram            #n_gram
    features[2]     = expression       #expression
    features[3]     = collocation      #collocation
    features[4]     = frequency_word   #word
    features[5]     = frequency_tag    #tag
    features[6]     = frequency_bigram #bigram
    features[7]     = tense            #tense
    features[8]     = voice            #voice
    features[9]     = extraposition    #extraposition
    features[10]    = norminalizing    #norminalizing
    features[11]    = modal            #modal
    features[12]    = pronoun          #pronoun
    features[13]    = toinf            #to_inf
    features[14]    = in_order         #in_order
    features[15]    = whether          #whether
    features[16]    = by               #by_ing
    features[17]    = ving             #verb_ing
    features[18]    = article          #article
    features[19]    = the              #the
    features[20]    = prep             #preposition
    features[21]    = move_before      #move_before
    features[22]    = to               #to
    features[23]    = we               #we
    features[24]    = this             #this
    return features
