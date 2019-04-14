docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' pjmysql001
docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' apache_server
docker inspect -f '{{range .Mounts}}{{.Source}}{{end}}' apache_server
