#!/usr/bin/env bash

source /app/provision/common.sh

#== Provision script ==

info "Provision-script user: `whoami`"

info "Restart db server"
service mariadb restart