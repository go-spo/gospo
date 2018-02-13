mkdir /opt/gospo/www
mkdir /opt/gospo/database
mkdir /opt/gospo/mysql
cp -r /opt/gospo/pruebaDespliegueGospo/* /opt/gospo/www
cp -r /opt/gospo/pruebaDespliegueGospo/database/* /opt/gospo/database
sleep 10
rm -rf /opt/gospo/www/database
rm -rf /opt/gospo/www/docs
rm -rf /opt/gospo/www/despliegue
docker run -d -p 80:8080 --net=red_docker --ip 192.168.1.68 --name gospo2 -v /opt/gospo/www:/var/www logongas/apache2-php7-ssl
docker run -d -p 3306:3306 --net=red_docker --ip 192.168.1.69 --name gospo2-mysql -v /opt/gospo/mysql:/var/lib/mysql -v /opt/gospo/database:/database -e MYSQL_ROOT_PASSWORD=root mysql
sleep 30 
docker exec -i -t gospo2-mysql /bin/bash /database/import.sh
