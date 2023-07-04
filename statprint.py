import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns
import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LogisticRegression
from sklearn import metrics
#%matplotlib inline

def func(t,h):
    f=open("pyout.txt","w")
    columns_x = ['Temperature','Humidity']
    # Load the data
    df = pd.read_csv("Book1_dataset.csv")
    f.write("5 rows of the dataset")
    f.write(str(df.head()))
    f.write("\n")
    f.write("Some basic statistical analysis about the data")
    f.write(str(df.describe()))
    print(sns.pairplot(df, hue='Label'))
    plt.savefig('foo.png', bbox_inches='tight')
    # Separate features and target  
    X = df[columns_x]
    y = df['Label']
    f.write("\n")
    f.write("X is :")
    f.write(str(X))
    f.write("\n")
    f.write("Y is :")
    f.write(str(y))
    # Split the data into train and test dataset.
    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.1)
    model=LogisticRegression()
    model.fit(X_train,y_train)
    #make predictions
    expected=y_test
    predicted=model.predict(X_test)
    f.write("\n")
    f.write("expected is :")
    f.write(str(expected))
    f.write("\n")
    f.write("predicted is :")
    f.write(str(predicted))
    f.write("\n")
    f.write(metrics.classification_report(expected,predicted))
    f.write(str(metrics.confusion_matrix(expected,predicted)))

    X_new = np.array([[t,h]])        
    predicted=model.predict(X_new)
    f.write("\n")
    f.write(str(X_new.shape))
    #print(y.shape)
    f.write("\n")
    f.write("predicted is :")
    f.write(str(predicted))
    f.write("\n")
    f.write("completed")
    
    f.close()
    f2=open("out.txt","w")
    f2.write(str(predicted))
    f2.close()