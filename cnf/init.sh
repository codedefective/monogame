#!/bin/bash

crontab /etc/crontab
mkdir -p "/var/www/html/log"
/usr/bin/supervisord -c /supervisord.conf