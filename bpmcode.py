import serial
import mysql.connector

ser = serial.Serial('COM3', 9600, timeout=5)
ser.readline()
ser.readline()
bpm=''

while (bpm==''):
    bpm=ser.readline().decode()
bpm=int(bpm)
print(bpm)
ser.close()

mydb = mysql.connector.connect(
  host="localhost",
  user="abcd",
  password="looneytunes",
  database="minor"
)

curs = mydb.cursor()
curs.execute("SELECT * FROM patientdata")
curs.fetchall()
n=curs.rowcount
n=n+1

curs = mydb.cursor()
sql = "INSERT INTO patientdata (id,heart_rate,bpm) VALUES (%s, %s, %s)"
val = (n, bpm, bpm)
curs.execute(sql, val)
mydb.commit()

mydb.close()