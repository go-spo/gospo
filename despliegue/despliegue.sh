mkdir /opt/gospo/www
mkdir /opt/gospo/database
mkdir /opt/gospo/mysql
cp -r /opt/gospo/gospo/www/* /opt/gospo/www
cp -r /opt/gospo/gospo/database/* /opt/gospo/database
docker run -d -p 80:8080 --net=red_docker --ip 192.168.1.68 --name gospo2 -v /opt/gospo/www:/var/www/html logongas/apache2-php7-ssl
docker run -d -p 3306:3306 --net=red_docker --ip 192.168.1.69 --name gospo2-mysql -v /opt/gospo/mysql:/var/lib/mysql -v /opt/gospo/database:/database -e MYSQL_ROOT_PASSWORD=root mysql
sleep 30 
docker exec -i -t gospo2-mysql /bin/bash /database/import3.sh
