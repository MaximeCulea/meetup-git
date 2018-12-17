# Preprod to Prod

## Dump SQL Preprod

    php72 tools/wp-cli.phar db export

## Rsync

    rsync -e ssh -rltDvz --delete-after wp-skeleton.beapi.preprod@wp-skeleton.beapi.preprod:/home/wp-skeleton.beapi.space/public_html/ /var/www/html/

## Import BDD

    php72 tools/wp-cli.phar db import xxxx.sql

## Script to change URL

    php tools/wp-cli.phar search-replace 'wp-skeleton.beapi.preprod' 'wp-skeleton.beapi.fr' --precise --all-tables


