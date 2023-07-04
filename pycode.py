import serial
import mysql.connector

ser = serial.Serial('COM3', 9600, timeout=5)
humidity=float(ser.readline().decode())
#print(humidity)
temp=float(ser.readline().decode())
#print(temp)
ser.close()

mydb = mysql.connector.connect(
  host="localhost",
  user="abcd",
  password="looneytunes",
  database="minor"
)

curs = mydb.cursor()
curs.execute("SELECT * FROM dht11")
curs.fetchall()
n=curs.rowcount
n=n+1

curs = mydb.cursor()
sql = "INSERT INTO dht11 (id, temp, humidity) VALUES (%s, %s, %s)"
val = (n, temp, humidity)
curs.execute(sql, val)
mydb.commit()

mydb.close()

import statprint
statprint.func(temp, humidity)