#!/bin/bash

docker_run_name="apache_server"


# Create image

docker build -t pjimages001/apache_server .

# Start Database

docker run -d --name=$docker_run_name pjimages001/apache_server


