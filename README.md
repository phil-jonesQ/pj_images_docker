## pj_images_docker

Assumes docker has been installed, docker group created and your sudo user has been added to the same group

# Network Create

docker network create --driver=bridge --subnet=192.168.200.0/24 --gateway=192.168.200.254 pj_images_vlan200

# Operation

Run ./start.sh to start the docker containers and pj-images.com can be accessed on port 80 --> http://192.168.200.1/show.php?category=Home

Run./stop.sh to shutdown the docker containers


