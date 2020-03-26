# exchange-demo
docker network create --driver bridge ms_network --subnet 172.245.245.0/24 --gateway 172.245.245.1

sudo vim /private/hosts
127.0.0.1 exhcange.ms
127.0.0.1 website.ms

./composer.phar install