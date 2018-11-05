#!/bin/bash

docker_run_name="pjmysql001"
docker_image_name="pjimages001\/mysql"
docker_image_id=$(docker images  | grep "pjimages001\/mysql" | awk '{print $3}')


echo "Removing container instance $docker_run_name"

docker rm -f $docker_run_name

echo "Removing image $docker_image_id"
if [ ! -z $docker_image_id ] ; then

	docker rmi -f $docker_image_id

fi
