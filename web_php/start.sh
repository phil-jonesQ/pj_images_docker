#!/bin/bash

#CONTAINER ID        IMAGE                       COMMAND                  CREATED             STATUS              PORTS               NAMES
#9b8a8bc075e0        pjimages001/apache_server   "/my_init"               8 minutes ago       Up 8 minutes        80/tcp              apache_server
#8a00253a2c9e        pjimages001/mysql:5.6_001   "docker-entrypoint..."   11 minutes ago      Up 11 minutes       3306/tcp            pjmysql001

started=0
who_am_i=$(whoami)

if [ -e /var/run/pjimages ] ; then
       	echo "pj-images already started!"
       	exit 2
fi

if [ $who_am_i != "root" ] ; then
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
	touch /var/run/pjimages
else
	echo "pjimages failed to start..."
fi
exit 0
