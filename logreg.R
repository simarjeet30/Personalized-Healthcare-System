x=read.csv("covid.csv")

mod=glm(fac ~ SpO2_saturation,data=x[1:500,c("fac","SpO2_saturation")],family = "binomial")

xsp<-seq(20, 100, 0.1)
ypr<-predict(mod,list(SpO2_saturation=xsp),type="response")

plot(x[1:500,"SpO2_saturation"],x[1:500,"fac"], pch = 16,xlim=c(20,100),ylim=c(0,1))

lines(xsp,ypr)


pred<-predict(mod,list(SpO2_saturation=x[501:1085,"SpO2_saturation"]),type="response")
tab<-cbind(pred,x[501:1085,"fac"])
source("f.R")
tab<-cbind(pred,x[501:1085,"fac"])
tab2<-sapply(tab[,"pred"], f)
tab[,"pred"]<-tab2
accuracy(tab)