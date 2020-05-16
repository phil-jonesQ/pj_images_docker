#!/bin/bash

started=0
who_am_i=$(whoami)

if [ -e /var/run/pjimages ] ; then
       	echo "pj-images already started!"
       	exit 2
fi

if [ $who_am_i != "philjones" ] ; then
	echo "Error: Must be run as root!"
	exit 2
fi


echo -n "Starting pj-images - please wait...."
cd ./mysql
./create.sh
if [ $? == 0 ] ; then
	let "started++"
fi
echo -n ".."
cd ../web_php
./create.sh
if [ $? == 0 ] ; then
	let "started++"
fi
echo -n ".."
cd ../mysql
./import_data.sh
if [ $? == 0 ] ; then
	let "started++"
fi

if [ $started -eq 3 ] ; then
	echo ""
	echo "pjimages has started..."
	sudo touch /var/run/pjimages
else
	echo "pjimages failed to start..."
fi
exit 0
