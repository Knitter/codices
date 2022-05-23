#!/usr/bin/env bash

source /app/build/server/provision/common.sh

#== Provision script ==

info "Provision-script user: `whoami`"

info "Restart PHP & DB services"
systemctl restart php8.1-fpm
systemctl restart nginx
systemctl restart redis-server