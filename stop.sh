#!/bin/bash

who_am_i=$(whoami)

if [ $who_am_i != "philipjones" ] ; then
        echo "Error: Must be run as root!"
        exit 2
fi

started=0

echo -n "Stopping pj-images - please wait...."
./mysql/destroy.sh > /dev/null 2>&1
if [ $? == 0 ] ; then
        let "started++"
fi
echo -n ".."
./web_php/destroy.sh > /dev/null 2>&1
if [ $? == 0 ] ; then
        let "started++"
fi
echo -n ".."

if [ $started -eq 2 ] ; then
        echo ""
        echo "pjimages has stopped..."
        sudo [ -e /var/run/pjimages ] && sudo rm -f /var/run/pjimages
else
        echo "pjimages failed to stop..."
fi
exit 0

