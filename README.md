# exchange-demo

## Set up environment

```
cd docker
docker network create --driver bridge ms_network --subnet 172.245.245.0/24 --gateway 172.245.245.1
docker-compose up -d
```

## Set up hosts

Update hosts file (e.g. /private/hosts in mac). Add new hosts:
```
127.0.0.1 exhcange.ms
127.0.0.1 website.ms
```

## Set up services

```
cd ../services/website
./composer.phar install
cd ../exchange
./composer.phar install
```

## Run website

Open in browser
```
http://website.ms:8880/
```

Exchange service endpoints (examples):

```
http://exchange.ms:8980/v1/currencies
http://exchange.ms:8980/v1/convert?from=USD&to=EUR&amount=100
```
