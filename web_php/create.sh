#!/bin/bash

docker_run_name="apache_server"


# Create image

docker build -t pjimages001/apache_server .

# Start Database

#docker run -d --name=$docker_run_name pjimages001/apache_server


#docker run -d --name=apache_server --restart=always --net pj_images_vlan200 --ip 192.168.200.1 -p 80:80 -v /root/pj_images_docker_deploy/pj_images_002_html:/var/www/html:z -v /root/pj_images_001/html/assets/:/var/www/html/assets pjimages001/apache_server

docker run -d --name=apache_server --restart=always --net pj_images_vlan200 --ip 192.168.200.1 -p 80:80 -v /root/pj_images_docker_deploy/pj_images_003_html:/var/www/html:z -v /root/pj_images_001/html/assets/:/var/www/html/assets pjimages001/apache_server
