## DEPEND TOOLS

```console
foo@bar:~$ sudo apt-get update && apt-get upgrade -y
```

```console
foo@bar:~$ sudo apt-get install -y software-properties-common curl build-essential dos2unix gcc git libmcrypt4 libpcre3-dev memcached make python2.7-dev python-pip re2c unattended-upgrades whois vim libnotify-bin nano wget debconf-utils python-software-properties git
```

```console
foo@bar:~$ sudo add-apt-repository ppa:ondrej/php
foo@bar:~$ sudo apt-get update
```

```console
foo@bar:~$ sudo apt-get install -y --force-yes php7.1-fpm php7.1-cli php7.1-dev php7.1-pgsql php7.1-sqlite3 php7.1-gd php-apcu php7.1-curl php7.1-mcrypt php7.1-imap php7.1-mysql php7.1-readline php-xdebug php-common php7.1-mbstring php7.1-xml php7.1-zip
```

```console
foo@bar:~$ sudo curl -sS https://getcomposer.org/installer | php 
foo@bar:~$ sudo mv composer.phar /usr/local/bin/composer 
foo@bar:~$ sudo printf "\nPATH=\"~/.composer/vendor/bin:\$PATH\"\n" | tee -a ~/.bashrc
```

```console
foo@bar:~$ sudo apt-get install -y nodejs
```

## DEPEND APPLICATION
| SYSTEM NAME  | URL  | 
| :------------ |:---------------:|
|MYSQL|[https://hub.docker.com/_/mysql/](https://hub.docker.com/_/mysql/)|
|INFLUXDB|[https://hub.docker.com/_/influxdb/](https://hub.docker.com/_/influxdb/)|
|REDIS|[https://hub.docker.com/_/redis/](https://hub.docker.com/_/redis/)|
|NODE-MEDIA-SERVER|[https://www.npmjs.com/package/node-media-server](https://www.npmjs.com/package/node-media-server)|
|LARAVEL-ECHO-SERVER|[https://www.npmjs.com/package/laravel-echo-server](https://www.npmjs.com/package/laravel-echo-server)|

## APPLICATION INSTALL

```console
foo@bar:~$ git clone https://github.com/isrg-solar-system/server-side.git
foo@bar:~$ cd server-side
foo@bar:~$ composer install
foo@bar:~$ cp .env.example .env
foo@bar:~$ nano .env
foo@bar:~$ php artisan migrate
foo@bar:~$ php artisan db:seed
```

## START DEPEND APPLICATION

START UP NODE-MEDIA-SERVER FOR RTMP

START UP LARAVEL-ECHO-SERVER TO HELP REALTIME DATA

## SYSTEM START
```console
foo@bar:~$ php artisan serve
```

```console
foo@bar:~$ php artisan queue:listen --queue=save --tries=1
```

```console
foo@bar:~$ php artisan queue:listen --queue=check --tries=1
```

```console
foo@bar:~$ php artisan queue:listen
```




