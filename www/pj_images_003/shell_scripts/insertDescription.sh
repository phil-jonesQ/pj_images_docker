#!/bin/bash


IFS=$'\n'
for i in $(php getData.php)

do

	my_id=$(echo $i|cut -f1 -d\|)
	my_name=$(echo $i|cut -f2 -d\||tr \' a)

	#echo $my_id $my_name
	/usr/local/bin/php insertDescription.php $my_id $my_name
done
