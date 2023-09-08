#!usr/bin/env python

import time
import RPi.GPIO as GPIO
from mfrc522 import SimpleMFRC522
import mysql.connector
from gpiozero import LED
from gpiozero import Buzzer

db = mysql.connector.connect(
    host="192.168.1.5",
    user="pi",
    passwd="12345678",
    database="rfid"
)

ledTrue = LED(12)
ledFalse = LED(16)
buzzer = Buzzer(26)

reader = SimpleMFRC522()
c1 = db.cursor()
c2 = db.cursor()
cursor = db.cursor()

try:
    while True:
        print('Place card to record attendance\n')
        id, text = reader.read()
        hex_id = hex(id)[2:].upper()
        
        cursor.execute("SELECT name, mssv FROM get_rfid WHERE rfid=HEX(%s)", (id,))
        result = cursor.fetchone()
        if cursor.rowcount >= 1:
            print("Welcome " + result[0])
            c1.execute("SELECT * FROM checkin WHERE rfid=HEX(%s)", (id,))
            c1.fetchall()
            c2.execute("SELECT * FROM checkout WHERE rfid=HEX(%s)", (id,))
            c2.fetchall()
            
            if c1.rowcount == c2.rowcount:
                c1.execute("INSERT INTO checkin (rfid, name, mssv) VALUES (HEX(%s), %s, %s)", (id, result[0], result[1],))
                for j in range(0,2):
                    ledTrue.toggle()
                    buzzer.toggle()
                    time.sleep(0.175)
                print("Checkin")
                time.sleep(1)
                db.commit()
                
            elif c1.rowcount > c2.rowcount:
                c2.execute("INSERT INTO checkout (rfid, name, mssv) VALUES (HEX(%s), %s, %s)", (id, result[0], result[1],))
                for j in range(0,2):
                    ledTrue.toggle()
                    buzzer.toggle()
                    time.sleep(0.175)

                print("Checkout")
                time.sleep(1)
                db.commit()
        else:
            print("RFID " + hex_id + " not found!")
            for i in range(0,6):
                buzzer.toggle()
                ledFalse.toggle()
                time.sleep(0.15)
        
        time.sleep(1)
finally:
    GPIO.cleanup()
                
            
