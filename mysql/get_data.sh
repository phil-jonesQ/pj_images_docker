docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' pjmysql
docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' apache_server
docker inspect -f '{{range .Mounts}}{{.Source}}{{end}}' apache_server
