#!/usr/bin/env bash

source /app/build/server/provision/common.sh
PHP_VERSION=8.1

#== Import script args ==

timezone=$(echo "$1")

#== Provision script ==

info "Provision-script user: `whoami`"

export DEBIAN_FRONTEND=noninteractive

info "Configure timezone"
timedatectl set-timezone ${timezone} --no-ask-password

info "Update OS software"
echo "set grub-pc/install_devices /dev/sda" | debconf-communicate
apt-get update
apt-get upgrade -y

apt-get install -y debconf-utils lsb-release ca-certificates apt-transport-https software-properties-common curl gnupg
echo "Done!"

echo "PHP SURY Repo"
echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/sury-php.list
wget -qO - https://packages.sury.org/php/apt.gpg | apt-key add -
echo "Done!"

echo "Redis Official Repo"
curl -fsSL https://packages.redis.io/gpg | gpg --dearmor -o /usr/share/keyrings/redis-archive-keyring.gpg
echo "deb [signed-by=/usr/share/keyrings/redis-archive-keyring.gpg] https://packages.redis.io/deb $(lsb_release -cs) main" | tee /etc/apt/sources.list.d/redis.list
echo "Done!"

echo "Preparing MariaDB"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password \"''\""
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password \"''\""
echo "Done!"

echo "Updating new repos"
apt-get update
echo "Done!"

info "Install additional software"
apt-get install -y  php7.3-xdebug php7.3-apcu unzip nginx

echo "Install additional software"
apt-get install -y vim php${PHP_VERSION}-curl php${PHP_VERSION}-cli php${PHP_VERSION}-intl php${PHP_VERSION}-gd \
php${PHP_VERSION}-fpm php${PHP_VERSION}-mbstring php${PHP_VERSION}-xml php${PHP_VERSION}-zip php${PHP_VERSION}-xdebug \
php${PHP_VERSION}-apcu php${PHP_VERSION}-pgsql php${PHP_VERSION}-soap php${PHP_VERSION}-mysql unzip nginx git redis \
mariadb-server mariadb-client nodejs npm default-jre php-pcov
echo "Done!"

info "Initailize databases for MySQL"
mysql -uroot <<< "CREATE DATABASE codices"
mysql -uroot <<< "CREATE DATABASE codices_test"
echo "Done!"

echo "Configure PHP and PHP-FPM"
sed -i 's/user = www-data/user = vagrant/g' /etc/php/${PHP_VERSION}/fpm/pool.d/www.conf
sed -i 's/group = www-data/group = vagrant/g' /etc/php/${PHP_VERSION}/fpm/pool.d/www.conf
sed -i 's/owner = www-data/owner = vagrant/g' /etc/php/${PHP_VERSION}/fpm/pool.d/www.conf
sed -i 's/display_errors = Off/display_errors = On/g' /etc/php/${PHP_VERSION}/fpm/php.ini
sed -i 's/memory_limit = 128M/memory_limit = 196/g' /etc/php/${PHP_VERSION}/fpm/php.ini
sed -i 's/post_max_size = 8M/post_max_size = 32M/g' /etc/php/${PHP_VERSION}/fpm/php.ini
sed -i 's/;date.timezone = /date.timezone = "Europe/Lisbon"/g' /etc/php/${PHP_VERSION}/fpm/php.ini
echo "Done!"

info "Configure MariaDB"
sed -i "s/.*bind-address.*/bind-address = 0.0.0.0/" /etc/mysql/mariadb.conf.d/50-server.cnf
mysql -uroot <<< "CREATE USER 'root'@'%' IDENTIFIED BY 'toor'"
mysql -uroot <<< "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%'"
mysql -uroot <<< "DROP USER 'root'@'localhost'"
mysql -uroot <<< "FLUSH PRIVILEGES"
echo "Done!"

echo "Configure xdebug"
rm /etc/php/${PHP_VERSION}/mods-available/xdebug.ini
rm /etc/php/${PHP_VERSION}/cli/conf.d/20-xdebug.ini
ln -s /app/build/server/php/xdebug.ini /etc/php/${PHP_VERSION}/mods-available/xdebug.ini
echo "Done!"

echo "Configure NGINX"
sed -i 's/user www-data/user vagrant/g' /etc/nginx/nginx.conf
echo "Done!"

echo "Enabling site configuration"
ln -s /app/build/server/nginx/app.conf /etc/nginx/sites-enabled/app.conf
echo "Done!"

echo "Enabling remaining services"
systemctl enable redis-server
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
echo "Done!"



