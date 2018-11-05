#!/bin/bash

docker_run_name="pjmysql001"

# Create image

docker build -t pjimages001/mysql:5.6_001 .

# Start Database

docker run -d --name=$docker_run_name pjimages001/mysql:5.6_001


