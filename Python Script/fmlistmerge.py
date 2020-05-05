# -*- coding: utf-8 -*-
"""
Created on Tue Apr 21 16:36:57 2020

@author: nick.langan
CSC 4797 Capstone Project
FMList Merge Script

This program performs the following:
    
    1.  Creates Pandas Dataframe containing all attributes from provided CSV spreadsheet of FM logs
    manually generated in Microsoft Excel.  (This spreadsheet was maintained from 2005-2015)
    2.  Creates second Pandas Dataframe containing all attributes from CSV spreadsheet output using
    FMList.org log tracking utility.  These are how my current FM logs are tracked 2015-present.
    3.  Concatenate the two dataframes into one dataframe.
    4.  De-duplicate the entries amongst the two dataframes.  Duplicates are searched for by the following
    criteria:
        - Duplicate call letters
        - Duplicate city of license and state on the same frequency
    5. A PDF output is generated containing the following graphs based on the new dataframe:
        - The most productive frequencies for FM logs, sorted greatest to least
        - A bar graph of the amount of FM logs based on several mile ranges:
            0 to 300
            300 to 500
            500 to 800
            800 to 1200
            1200 to 1450
            1450 to 1800
            1800 and above
        - The most productive states and provinces for FM logs, sorted greatest to least
        - The most productive seasons for FM logs
        - The most productive months of all time for FM logs
        - The most productive calendar dates for FM logs
    6. Finally, a CSV is outputted with the newly concatenated and scrubbed Pandas Dataframe data.
        
"""

import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
import seaborn as sns
sns.set()
from matplotlib.backends.backend_pdf import PdfPages

pieces = []
#Create the columns for the first FM log dataframe
columns = ['Freq', 'Calls', 'City', 'State', 'Year', 'Date', 'Miles', 'Prop']

#Input from CSV my original FM spreadsheet log
path = 'C:/Users/nick.langan.NLANGAN-LT/OneDrive - Villanova University/Spring 20/CSC4797/project/florencelog.csv'
frame = pd.read_csv(path,names=columns,encoding='latin-1') 
pieces.append(frame)
#Create the Pandas dataframe
fmlog1 = pd.concat(pieces)

#April 11, 2005 is the date when I began keeping my log.  Many of the stations I can always hear
#(such as Philadelphia and New York stations) do not have a date of log in my spreadsheet.  Thus,
#I set their log date as the first such date possible, April 11.  
fmlog1['Date'].fillna('4/11', inplace=True)

fmlog1.Year = fmlog1.Year.astype(str)
fmlog1.Date = fmlog1.Date.astype(str)

#My spreadsheet kept day and year as separate columns.  Here, I join the columns for easier use.
fmlog1['Date'] = fmlog1[['Date', 'Year']].apply(lambda x: '/'.join(x), axis=1)

#Change date to datetime object.
fmlog1['Date']= pd.to_datetime(fmlog1['Date']) 

pieces2 = []
#Create the columns for the FMList dataframe
columns2 = ['Freq', 'Date', 'Prop', 'Country', 'Calls', 'City', 'State', 'Miles', 'A', 'B']

#Input from CSV my FMList spreadsheet log
path = 'C:/Users/nick.langan.NLANGAN-LT/OneDrive - Villanova University/Spring 20/CSC4797/project/fmlist.csv'
frame = pd.read_csv(path, names=columns2,encoding='latin-1')
pieces2.append(frame)
#Create the Pandas dataframe
fmlog2 = pd.concat(pieces2)

#The FMList spreadsheet needed some extra scrubbing.  First, I removed any part of the call letters
#that contain the character r: and anything after that character sequence.
fmlog2['Calls'] = fmlog2.Calls.map(lambda x: x[0: x.find('r:') - 1] if 'r:' in x else x)

#Changed data in date column from period to dash.
fmlog2['Date'] = fmlog2['Date'].str.replace('.','-')

#Rid the calls column of any entries that contained -FM, -HD, or extraneous spaces.
fmlog2['Calls'] = fmlog2['Calls'].str.replace(r'-FM', '')
fmlog2['Calls'] = fmlog2['Calls'].str.replace(r'-HD', '')
fmlog2['Calls'] = fmlog2['Calls'].str.replace(r'[ ].*', '')

#Rid all '/' charactersin the city column.,  
fmlog2['City'] = fmlog2['City'].str.replace(r'[/].*', '')

#Change date to datetime object.
fmlog2['Date']= pd.to_datetime(fmlog2['Date'], dayfirst=True) 

#######Concatenate the two FM log dataframes together, perform deduping by call letters
df = pd.concat([fmlog1, fmlog2])\
       .sort_values('Date')\
       .drop_duplicates(subset=['Calls'], keep='first')
       
del df['A']
del df['B']

#Move forward with the following columns
df = df[['Freq', 'Calls', 'Date', 'Prop', 'Country', 'City', 'State', 'Miles']]

#Drop duplicates that have the same frequency, city, and state/province
df = df.drop_duplicates(subset=['Freq', 'City', 'State']) 

#Commented duplicate test code
#duplicateRowsDF = df.duplicated(['Freq', 'Miles'])
#df = df.drop_duplicates(subset=['Freq', 'Miles']) 
#duplicateRowsDF = df[df.duplicated(['Freq', 'City'])]
#print("Duplicate Rows based on a single column are:", duplicateRowsDF, sep='\n')

#Sort the new data frame values by frequency, then mileage 
df = df.sort_values(['Freq', 'Miles'])

#Output the scrubbed, combined FM log to CSV
df.to_csv(r'C:/Users/nick.langan.NLANGAN-LT/Desktop/New FM Log.csv')




##############GRAPHS/MATPLOTLIB GENERATION SECTION################################

#Create extra month column
df['month'] = pd.DatetimeIndex(df['Date']).month

#Function to output all of the following graphs to PDF file
with PdfPages('C:/Users/nick.langan.NLANGAN-LT/Desktop/dxgraphs.pdf') as pdf: 
    
#Graph the value of logs for all frequencies  
    june90s = df['Freq'].value_counts().reindex(df.Freq.unique(), fill_value=0).sort_index()
    fig, ax = plt.subplots(figsize=(19,10))
    june90s.nlargest(50).plot(kind='bar', ax=ax, legend=None, title='Most productive freqs in terms of new FM logs (all propagation methods)')
    for p in ax.patches:
        ax.annotate(str(p.get_height()), (p.get_x() * 1.000, p.get_height() * 1.005), weight='bold')
   
    df.Miles = pd.to_numeric(df.Miles, errors='coerce')
    df.dropna(subset=['Miles'])

#Generate ranges for mileage bar graph
    conditions = [   
    (df['Miles'] >= 0) & (df['Miles'] < 300),
    (df['Miles'] >= 300) & (df['Miles'] < 500),
    (df['Miles'] >= 500) & (df['Miles'] < 800),
    (df['Miles'] >= 800) & (df['Miles'] < 1200),
    (df['Miles'] >= 1200) & (df['Miles'] < 1450),
    (df['Miles'] >= 1450) & (df['Miles'] < 1800),
    (df['Miles'] >= 1800) & (df['Miles'] < 2500)
    ]
    choices = ['0-300', '300-500', '500-800', '800-1200', '1200-1450', '1450-1800', '1800+']
    
    df['Range'] =  np.select(conditions, choices)

    df = df[df.Range != '0'] 
    
#Graph the values of log based on mileage ranges 
    june90s = df['Range'].value_counts().reindex(df.Range.unique(), fill_value=0).sort_values(ascending=True)
    fig, ax = plt.subplots(figsize=(15,10))
    june90s.plot(kind='bar', ax=ax, legend=None, title='Mile ranges in terms of new FM logs (all propagation methods)')
    for p in ax.patches:
        ax.annotate(str(p.get_height()), (p.get_x() * 1.000, p.get_height() * 1.005), weight='bold')

#Graph the values of logs based on state/provinces    
    june90s = df['State'].value_counts().reindex(df.State.unique(), fill_value=0).sort_index()
    fig, ax = plt.subplots(figsize=(21,10))
    june90s.nlargest(50).plot(kind='bar', ax=ax, legend=None, title='Most productive states in terms of new FM logs (all propagation methods)').get_figure()
    for p in ax.patches:
        ax.annotate(str(p.get_height()), (p.get_x() * 1.000, p.get_height() * 1.005), weight='bold')
    pdf.savefig(fig)

#Drop any values in the dataframe that do not have a date assigned
    df = df.dropna(subset=['Date'])    

#Create extra columns for use with date graphs
    df['day'] = pd.DatetimeIndex(df['Date']).day
    df['year'] = pd.DatetimeIndex(df['Date']).year
    df['month_year'] = df.Date.dt.to_period('M')
    df['day_year'] = df.Date.dt.to_period('D')
 
#Create conditions for yearly seasons
    conditions = [
    (df['month'] >= 3) & (df['month'] < 6),
    (df['month'] >= 6) & (df['month'] < 9),
    (df['month'] >= 9) & (df['month'] < 12),
    (df['month'] < 3) | (df['month'] == 12)]
    choices = ['spring', 'summer', 'fall', 'winter']
    df['Season'] =  np.select(conditions, choices)

#Graph the values of logs based on calendar season
    june90s = df['Season'].value_counts().reindex(df.Season.unique(), fill_value=0).sort_index()
    fig, ax = plt.subplots(figsize=(10,10))
    june90s.plot(kind='bar', ax=ax, legend=None, title='Most productive seasons in terms of new FM logs (all propagation methods)').get_figure()
    pdf.savefig(fig)

#Graph the values of logs based on each year observed
    june90s = df['year'].value_counts().reindex(df.year.unique(), fill_value=0).sort_index()
    fig, ax = plt.subplots(figsize=(10,10))
    ye = df.groupby(['year']).sum()
    june90s.plot(kind='bar', ax=ax, legend=None, title='Most productive years in terms of new FM logs (all propagation methods)').get_figure()
    pdf.savefig(fig)

#Graph the most active months based on log amounts 
    june90s = df['month_year'].value_counts().reindex(df.month_year.unique(), fill_value=0).sort_index()
    fig, ax = plt.subplots(figsize=(10,10))
    june90s.nlargest(10).plot(kind='bar', ax=ax, legend=None, title='Most productive months in terms of new FM logs (all propagation methods').get_figure()
    pdf.savefig(fig)

    df['month_day'] = df['Date'].dt.strftime('%m-%d')

#Graph the most active calendar days based on log amounts
    june90s = df['month_day'].value_counts().reindex(df.month_day.unique(), fill_value=0).sort_index()
    fig, ax = plt.subplots(figsize=(10,10))
    june90s.nlargest(10).plot(kind='bar', ax=ax, legend=None, title='Most productive days of the month in terms of new FM logs (all propagation methods').get_figure()
    pdf.savefig(fig)


