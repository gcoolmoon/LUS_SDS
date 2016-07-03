__author__ = 'gebre'
import collections
import sys
import operator
import re
import math
def getwords( str ):
    g = open("Data/NLSPARQL.train.words.txt", "w")
    with open('Data/NLSPARQL.train.tok') as fp:
        for line in fp:
            values = line.split()
            for word in values:
                g.write(word.rstrip('\r\n') + "\n")
    "This prints a passed string into this function"
    print str
    return
def uniquewords(str):
    g = open("Data/NLSPARQL.train.uwords.txt", "w")
    values = []
    with open('Data/NLSPARQL.train.words.txt') as fp:
        for line in fp:
            values.append(line)
        values = set(values)
    for val in values:
        g.write(val)
    return values
def Probablity(word, clas):
    g = open("Data/condProba.txt", "w")
    #smoothing
    counter = 1
    with open('Data/outputtrain.utt.tok.txt') as fp:
        for line in fp:
            values = line.split("\t")
            #print values[1]
            #print clas
            if(values[1].rstrip('\r\n')==clas):
                words = values[0].split()
                #counters=collections.Counter(words)
                #print(counters)
                counter = counter + words.count(word)
                #print(counter)
    return counter
def countclas(clas):
    counter = 0
    with open('Data/outputtrain.utt.tok.txt') as fp:
        for line in fp:
            values = line.split("\t")
            if(values[1].rstrip('\r\n')==clas):
                words = values[0].split()
                counter = counter + len(words)
    #print counter
    return counter
def getvocabulary(clas):
    counter = 0
    with open('Data/NLSPARQL.train.uwords.txt') as fp:
        for line in fp:
            counter = counter +1
    #print counter
    return counter
def conditionalProb(word, clas):
    countw = Probablity(word,clas)
    deno = int(countclas(clas))+int(getvocabulary(clas))
    result =  float(countw)/deno
    return result

def setClass():
    x = 1
    max =0
    utt = "something"
    g = open("Data/NLSPARQL.test.results.txt", "w")
    with open('Data/NLSPARQL.test.tok') as fp:
        for line in fp:
            max = 0
            values = line.split()
            print ("==============================================================================")
            with open('Data/NLSPARQL.utt.prob') as f:
                for li in f:
                    x=1
                    classespro = li.split("\t")
                    #print classespro[1].rstrip('\r\n')
                    x = x*float(classespro[1].rstrip('\r\n'))
                    for val in values:
                        x = x * conditionalProb(val,classespro[0])
                    print x
                    print max
                    print classespro[0]
                    if(max < x):
                        max=x
                        utt = classespro[0]
                        print max
                        print "s"
            print utt
            g.write(line.rstrip("\r\n")+ "\t" + str(utt) + "\t"+str(max)+"\n")
            print "shit"

def setClassValue(value):
    x = 1
    max =0
    list= []
    utt = "something"
    g = open("Data/NLSPARQL.tester.results.txt", "w")
    max = 0

    values = re.sub("[^\w]", " ",  value).split()
    with open('Data/NLSPARQL.utt.prob') as f:
        for li in f:
            x=1
            classespro = li.split("\t")
            #print classespro[1].rstrip('\r\n')
            x = x+math.log(1/float(classespro[1].rstrip('\r\n')))
            for val in values:
                x = x +math.log(1/ conditionalProb(val,classespro[0]))
            #print x
            #print max
            #print classespro[0]
            list1 = [classespro[0], x]
            list.append(list1)
            #print list
            if(max < x):
                max=x
                utt = classespro[0]
                #print max
                #print "s"
    #print utt
    #g.write(value + "\t" + str(utt) + "\t"+str(max)+"\n")
    list.sort(key=operator.itemgetter(1))
    for sm in list[:5]:
        for ss in sm:
            g.write(str(ss)+"\t")
        g.write("\n")
    print list[:5]
    return list

#setClass()
setClassValue(sys.argv[1])