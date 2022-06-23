#!/bin/bash

crontab /etc/crontab
/usr/bin/supervisord -c /supervisord.conf