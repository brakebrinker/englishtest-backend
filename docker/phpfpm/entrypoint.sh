#!/bin/bash

chmod -R 777 storage
chown -R www-data:www-data .

exec "$@"