#!/bin/bash


docker_container_name="pjmysql"
docker_run_name=$(docker ps | grep $docker_container_name | awk '{print $1}')
docker_image_name="pj_images_sql"
docker_image_id=$(docker images  | grep $docker_image_name | awk '{print $3}')



docker_run_name="pjmysql"

# Create image

docker build -t $docker_image_name .

# Start Database

docker run -d --restart=always --net pj_images_vlan200 --ip 192.168.200.2 --name=$docker_run_name $docker_image_name:latest

