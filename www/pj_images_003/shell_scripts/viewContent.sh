#!/bin/sh

## Helper script to list out content and symlink

categoryCall=$1

myAvailable=$(/usr/local/bin/php /home/alfa/shell_scripts/readData.php|grep $categoryCall)

echo $myAvailable
