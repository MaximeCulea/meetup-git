# Prod to Dev

## Dump SQL DEV

    php72 tools/wp-cli.phar db export

## Rsync

    rsync -e ssh -rltDvz /var/www/html/ wp-skeleton.beapi.space@wp-skeleton.beapi.space:/home/wp-skeleton.beapi.space/public_html/

## Import BDD

    php72 tools/wp-cli.phar db import xxxx.sql

## Script to change URL

    php tools/wp-cli.phar search-replace 'wp-skeleton.beapi.fr' 'wp-skeleton.beapi.space' --precise --all-tables


