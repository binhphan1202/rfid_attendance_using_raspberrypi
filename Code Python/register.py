#!usr/bin/env python

import time
import RPi.GPIO as GPIO
from mfrc522 import SimpleMFRC522
import mysql.connector
from gpiozero import Buzzer

db = mysql.connector.connect(
    host="192.168.1.5",
    user="pi",
    passwd="12345678",
    database="rfid"
)

cursor = db.cursor()
reader = SimpleMFRC522()
# mylcd = LCD_I2C_Driver.lcd()
buzzer = Buzzer(26)

try:
    print("Place card to register\n")
    id, text = reader.read()
    hex_id = hex(id)[2:].upper()
    cursor.execute("SELECT name, mssv FROM get_rfid WHERE rfid=HEX(%s)", (id,))
    result = cursor.fetchone()
    if cursor.rowcount >= 1:
        # mylcd.lcd_clear()
        # mylcd.lcd_display_string("Overwriting\nexisting user?", 1)
        for i in range(0,2):
            buzzer.toggle()
            time.sleep(0.25)
        
        print("UID exists\n")
        print("UID = " + hex_id + "\n")
        print("Name: " + result[0])
        print("MSSV: " + result[1])
        
    else:
        sql_insert = "INSERT INTO get_rfid (rfid, name, mssv) VALUES (HEX(%s), %s, %s)"
        
        new_name = input("Enter new name: ")
        mssv = input("MSSV: ")
        
    # mylcd.lcd_clear()
    # mylcd.lcd_display_string("Enter new name", 1)
        cursor.execute(sql_insert, (id, new_name, mssv,))
        for i in range(0,6):
            buzzer.toggle()
            time.sleep(0.15)
        
        db.commit()
    
    # mylcd.lcd_clear()
    # mylcd.lcd_display_string("User " + new_name + "\nSaved", 1)
        print("UID " + hex_id + " Saved")
        time.sleep(1)
finally:
    GPIO.cleanup()
        

