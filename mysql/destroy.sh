#!/bin/bash

docker_container_name="pjmysql"
docker_run_name=$(docker ps | grep $docker_container_name | awk '{print $1}')
docker_image_name="pj_images_sql"
docker_image_id=$(docker images  | grep $docker_image_name | awk '{print $3}')


echo "Removing container instance $docker_run_name"

docker rm -f $docker_run_name

echo "Removing image $docker_image_id"
if [ ! -z $docker_image_id ] ; then

	docker rmi -f $docker_image_id

fi
