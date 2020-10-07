#!/usr/bin/env bash

source /app/_vagrant/provision/common.sh

#== Provision script ==

info "Provision-script user: `whoami`"

info "Restart web-stack"
service php7.3-fpm restart
service nginx restart
service mariadb restart