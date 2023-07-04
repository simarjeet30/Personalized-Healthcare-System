args=commandArgs(TRUE)
sp = as.numeric(args[1])
arg2 = as.numeric(args[2])
x=read.csv("C:/xampp/htdocs/minor/covid.csv")
source("C:/xampp/htdocs/minor/accuracy.R")
source("C:/xampp/htdocs/minor/f.R")
source("C:/xampp/htdocs/minor/bestmodel.R")
mod=bestmodel()
predicted=ceiling(predict(mod,list(SpO2_saturation=sp),type="response")-0.5)
if (predicted==0) predicted='Not infected'
if (predicted==1) predicted='Infected'

library(RMySQL)
mydb = dbConnect(MySQL(), user = "abcd", password = "looneytunes", dbname = "minor", host = "localhost")
query=paste("UPDATE patientdata SET Health_status='",predicted,"' WHERE id=",arg2)
res=dbSendQuery(mydb,query)
dbDisconnect(mydb)