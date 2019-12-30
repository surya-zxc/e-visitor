#! /usr/bin/env python2.7
import re, argparse
from smartcard.System import readers
from smartcard.util import toHexString
import datetime, sys
from connection import connection

#ACS ACR122U NFC Reader
#Suprisingly, to get data from the tag, it is a handshake protocol
#You send it a command to get data back
#This command below is based on the "API Driver Manual of ACR122U NFC Contactless Smart Card Reader"
COMMAND = [0xFF, 0xCA, 0x00, 0x00, 0x00] #handshake cmd needed to initiate data transfer
GET_UID = [0xFF,0xCA,0x00,0x00,0x04]
GET_PICC = [0xFF,0x00,0x50,0x00,0x00]
GET_FIRMWARE = [0xFF,0x00,0x48,0x00,0x00]
# get all the available readers
r = readers()
print "Available readers:", r


def stringParser(dataCurr):
#--------------String Parser--------------#
    #([85, 203, 230, 191], 144, 0) -> [85, 203, 230, 191]
    if isinstance(dataCurr, tuple):
        temp = dataCurr[0]
        code = dataCurr[1]
    #[85, 203, 230, 191] -> [85, 203, 230, 191]
    else:
        temp = dataCurr
        code = 0

    dataCurr = ''

    #[85, 203, 230, 191] -> bfe6cb55 (int to hex reversed)
    for val in temp:
        # dataCurr += (hex(int(val))).lstrip('0x') # += bf
        dataCurr += format(val, '#04x')[2:] # += bf

    #bfe6cb55 -> BFE6CB55
    dataCurr = dataCurr.upper()

    #if return is successful
    if (code == 144):
        return dataCurr

def getData():
    try:
        reader = r[0]
        connection = reader.createConnection()
        status_connection = connection.connect()
        data, sw1, sw2 = connection.transmit(GET_UID)    
        return toHexString(data)
    except Exception as e:
        pass

def getFW():
    try:
        reader = r[0]
        connection = reader.createConnection()
        status_connection = connection.connect()
        resp = connection.transmit(GET_FIRMWARE)    
        return stringParser(resp)
    except Exception as e:
        pass
    

def readTag(page):
    readingLoop = 1
    while(readingLoop):
        try:
            connection = reader.createConnection()
            status_connection = connection.connect()
            resp = connection.transmit(COMMAND)
            #Read command [FF, B0, 00, page, #bytes]
            #resp = connection.transmit([0xFF, 0xB0, 0x00, int(page), 0x04])
            #print resp
            dataCurr = stringParser(resp)

            #only allows new tags to be worked so no duplicates
            if(dataCurr is not None):
                print dataCurr
                break
            else:
                print "Something went wrong. Page " + str(page)
                break
        except Exception,e: 
            if(waiting_for_beacon ==1):
                continue
            else:
                readingLoop=0
                print str(e)
                break

def writeTag(page, value):
    if type(value) != str:
        print "Value input should be a string"
        exit()
    while(1):
        if len(value) == 8:
            try:
                connection = reader.createConnection()
                status_connection = connection.connect()
                connection.transmit(COMMAND)
                WRITE_COMMAND = [0xFF, 0xD6, 0x00, int(page), 0x04, int(value[0:2], 16), int(value[2:4], 16), int(value[4:6], 16), int(value[6:8], 16)]
                # Let's write a page Page 9 is usually 00000000
                resp = connection.transmit(WRITE_COMMAND)
                if resp[1] == 144:
                    print "Wrote " + value + " to page " + str(page)
                    break
            except Exception, e:
                continue
        else:
            print "Must have a full 4 byte write value"
            break

if __name__ == "__main__":
    parser = argparse.ArgumentParser(description='NFC reader for E-Visitor')
    parser.add_argument("--m",required=True, help="Mode :\n[1 : Visitor Logs *Required Area ID]\n[2 : Insert Card to DB]")
    parser.add_argument("--a",default='1', help="Area ID [default=1]")

    args = parser.parse_args()
    c = connection()
    if args.m == '1':
        print "Visitor Logs"
        areaId = args.a
        print "Area ID : "+areaId
        
        while True:
            data = getData()
            if data is not None:
                print(c.insertVisitationActivityLogs(areaId,str(data)))
    elif args.m == '2':
        print "Mode Inserd Card to DB"
        while True:
            data = getData()
            if data is not None:
                print(c.insertVisitorCard(str(data)))
    else:
        print "invalid option"