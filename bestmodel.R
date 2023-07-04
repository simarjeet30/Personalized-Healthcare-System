bestmodel <- function()
{
    acc=0
    train=sample.int(1085, 500, replace = TRUE)
    test=setdiff(1:1085,train)
    mainmod=glm(fac ~ SpO2_saturation,data=x[train,c("fac","SpO2_saturation")],family = "binomial")
    for (i in 1:100)
    {
        train=sample.int(1085, 500, replace = TRUE)
        test=setdiff(1:1085,train)
        mod=glm(fac ~ SpO2_saturation,data=x[train,c("fac","SpO2_saturation")],family = "binomial")
        pred<-predict(mod,list(SpO2_saturation=x[test,"SpO2_saturation"]),type="response")
        tab<-cbind(pred,x[test,"fac"])
        tab<-cbind(pred,x[test,"fac"])
        tab2<-sapply(tab[,"pred"], f)
        tab[,"pred"]<-tab2
        temp=accuracy(tab)
        if (temp>acc)
        {
            acc=temp
            mainmod=mod
        }
    }
    mainmod
}