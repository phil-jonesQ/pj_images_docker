#!/bin/bash

docker_run_name="pjmysql001"

# Create image

docker build -t pjimages001/mysql:5.6_001 .

# Start Database

docker run -d --restart=always --net pj_images_vlan200 --ip 192.168.200.2 --name=$docker_run_name pjimages001/mysql:5.6_001


