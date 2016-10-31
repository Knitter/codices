#!/usr/bin/env bash

# export LC_ALL=en_US.UTF-8
# export LANG=en_US.UTF-8
# export DEBIAN_FRONTEND=noninteractive

# stopping services to change settings
sudo service apache2 stop
sudo service mysql stop

# updating base system
sudo apt-get -q -y update && sudo apt-get -q -y upgrade

# setting up links/files
sudo ln -s /vagrant/public/app /var/www/html/codices
sudo ln -s /vagrant/public/rest /var/www/html/codices-rest

sudo service apache2 start
sudo service mysql start
