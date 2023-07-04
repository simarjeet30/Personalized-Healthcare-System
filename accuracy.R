accuracy <- function(tab)
    {count<-0
    for (i in 1:nrow(tab))
    {
        if (tab[i,1]==tab[i,2])
        {
            count<-count+1
        }
    }

    (count*100)/nrow(tab)}