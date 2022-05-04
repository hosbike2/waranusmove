import re
import nltk
import random

def grammar_feature(sents,pos):
    
    #features = {}       #Dictionary in Python
    features=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]
    tense = 1
    voice = 1
    position = ""
    extra = 0
    norm = 0
    modal = 0
    pron = 0
    toinf = 0
    by = 0
    inor = 0
    whe = 0
    art = 0
    ving = 0
    conj = 0
    det = 0
    the = 0
    prep = 0

    tokens = nltk.word_tokenize(sents)
    tagged = nltk.pos_tag(tokens)
    
    str = ""
    for tag in tagged:
        str += tag[0]+"/"+tag[1]+" "
    position = pos
    
    #Present Tense
    if re.match(r'.*(\bhas\b|\bhave\b).*\bbeen\b.*\bVBN\b',str) :
        tc = "Present Perfect 2"
        tense = 1
        voice = 2
    elif re.match(r'.*(\bhas\b|\bhave\b).*\bbeen\b.*\bbeing\b.*\bVBN\b',str) :
        tc = "Present Perfect Continuous 2"
        tense = 1
        voice = 2
    elif re.match(r'.*(\bhas\b|\bhave\b).*\bbeen\b.*\bVBG\b',str) :
        tc = "Present Perfect Continuous 1"
        tense = 1
        voice = 1
    elif re.match(r'.*(\bhas\b|\bhave\b).*\bVBN\b',str) :
        tc = "Present Perfect 1"
        tense = 1
        voice = 1
    elif re.match(r'.*(\bis\b|\bam\b|\bare\b).*\bbeing\b.*\bVBN\b',str) :
        tc = "Present Continuous 2"
        tense = 1
        voice = 2
    elif re.match(r'.*(\bis\b|\bam\b|\bare\b).*\bVBN\b',str) :
        tc = "Present Simple 2"
        tense = 1
        voice = 2
    elif re.match(r'.*(\bVBZ\b|\bVBP\b|\bVB\b)',str) :
        tc = "Present Simple 1"
        tense = 1
        voice = 1
    elif re.match(r'.*(\bis\b|\bam\b|\bare\b).*\bVBG\b',str) :
        tc = "Present Continuous 1"
        tense = 1
        voice = 1
    
        

    #Past Tense
    if re.match(r'.*\bhad\b.*\bbeen\b.*\bbeing\b.*\bVBN\b',str) :
        tc = "Past Perfect Continuous 2"
        tense = 2
        voice = 2
        
    elif re.match(r'.*\bhad\b.*\bbeen\b.*\bVBG\b',str) :
        tc = "Past Perfect Continuous 1"
        tense = 2
        voice = 1
    
    elif re.match(r'.*\bhad\b.*\bVBN\b',str) :
        tc = "Past Perfect 1"
        tense = 2
        voice = 1
    
    elif re.match(r'.*\bhad\b.*\bbeen\b.*\bVBN\b',str) :
        tc = "Past Perfect 2"
        tense = 2
        voice = 2
    elif re.match(r'.*(\bwas\b|\bwere\b).*\bVBN\b',str) :
        tc = "Past Simple 2"
        tense = 2
        voice = 2
    elif re.match(r'.*\bVBD\b',str) :
        tc = "Past Simple 1"
        tense = 2
        voice = 1
    elif re.match(r'.*(\bwas\b|\bwere\b).*\bVBG\b',str) :
        tc = "Past Continuous 1"
        tense = 2
        voice = 1
    elif re.match(r'.*(\bwas\b|\bwere\b).*\bbeing\b.*\bVBN\b',str) :
        tc = "Past Continuous 2"
        tense = 2
        voice = 2
        

    #Future Tense    
    if re.match(r'.*\bwill\b.*\bhave\b.*\bbeen\b.*\bbeing\b.*\bVBN\b',str) :
        tc = "Future Perfect Continuous 2"
        tense = 3
        voice = 2
    elif re.match(r'.*\bwill\b.*\bhave\b.*\bbeen\b.*\bVBG\b',str) :
        tc = "Future Perfect Continuous 1"
        tense = 3
        voice = 1
    elif re.match(r'.*\bwill\b.*\bhave\b.*\bVBN\b',str) :
        tc = "Future Perfect 1"
        tense = 3
        voice = 1
    elif re.match(r'.*\bwill\b.*\bhave\b.*\bbeen\b.*\bVBN\b',str) :
        tc = "Future Perfect 2"
        tense = 3
        voice = 2
    elif re.match(r'.*\bwill\b.*\bbe\b.*\bVBG\b',str) :
        tc = "Future Continuous 1"
        tense = 3
        voice = 1
    elif re.match(r'.*\bwill\b.*\bbe\b.*\bbeing\b.*\bVBN\b',str) :
        tc = "Future Continuous 2"
        tense = 3
        voice = 2
    elif re.match(r'.*(\bwill\b|\bcan\b|\bcould\b|\bmay\b|\bcould\b).*\bbe\b.*\bVBN\b',str) :
        tc = "Future Simple 2"
        tense = 3
        voice = 2
    elif re.match(r'.*\bwill\b.*(\bVB\b|\bVBP\b)',str) :
        tc = "Future Simple 1"
        tense = 3
        voice = 1

    
    #Extraposition
    if re.match(r'.*\bIt\b.*(\bis\b|\bam\b|\bare\b|\bwas\b|\bwere\b).*\bthat\b',str):
        extra = 1
    elif re.match(r'.*\bIt\b.*(\bis\b|\bam\b|\bare\b|\bwas\b|\bwere\b)',str):
        extra = 1
    
    #Norminalizing
    if re.match(r'.*\bThe\b.*\bof\b',str):
        norm = 1

    #Modal
    if re.match(r'.*(\bwill\b|\bshall\b|\bcan\b|\bcould\b|\bmay\b|\bmight\b|\bwould\b|\bshould\b)',str):
        modal = 1

    #Pronoun
    if re.match(r'.*(\bWe\b|\bOur\b|\bOurs\b|\bwe\b|\bour\b|\bours\b|\bThis\b|\bthis\b|\bThese\b|\bthese\b)',str):
        pron = 1

    #TO
    if re.match(r'.*(\bTo\b|\bto\b).*(\bVB\b|\bVBZ\b|\bVBP\b)',str):
        toinf = 1
    if re.match(r'.*\bIn\b.*\border\b.*\bto\b',str):
        inor = 1
    if re.match(r'.*\bwhether\b',str):
        whe = 1
    
    #ByING
    if re.match(r'.*\bby\b.*\bVBG\b',str):
        by = 1
    if re.match(r'.*\bVBG\b',str):
        ving = 1
        
    #Article
    if re.match(r'.*(\bA\b|\bAn\b)',str):
        art = 1

    #The
    if re.match(r'.*\bThe\b',str):
        the = 1
    
    #Preposition
    if re.match(r'.*(\bin\b|\bover\b|\bbetween\b|\binto\b|\bat\b|\bfrom\b|\bby\b|\bfor\b|\bon\b|\bunder\b|\bthough\b|\bduring\b|\bamong\b)',str):
        prep = 1

    #features=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]
    features[0]     = inor    #inorder
    features[1]     = whe     #whether
    features[2]     = tense   #tense
    features[3]     = voice   #voice
    features[4]     = extra   #extra
    features[5]     = norm    #norm
    features[6]     = position#pos
    features[7]     = modal   #modal
    features[8]     = pron    #pronoun
    features[9]     = toinf   #toinf
    features[10]    = by      #bying
    features[11]    = ving    #ving
    features[12]    = art     #article
    features[13]    = the     #the
    features[14]    = prep    #preposition
    return features
