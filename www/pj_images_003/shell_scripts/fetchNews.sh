#!/bin/bash

# Define Variables

NewsURL="https://newsapi.org/v2/top-headlines?country=gb&category=business&apiKey=d59a7b19f7c641e2b8f88e7affeb7874"

NewsFile="/home/alfa/includes/news.json"

# Fetch News and store to file

curl "$NewsURL" > $NewsFile

# Check file status was ok

ok=$(cat /home/alfa/includes/news.json | awk -F ":" '{print $2}'|cut -d\" -f2 | grep -c ok)

if [ $ok -gt 0 ] ; then

	echo "$(date) Fetched News Data OK.." >> /home/alfa/logs/news_fetch.log
else

	echo "$(date) Fetched News Data FAILED.." >> /home/alfa/logs/news_fetch.log
fi

exit 0
