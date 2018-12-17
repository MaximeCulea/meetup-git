# Dev to Preprod

## Dump SQL DEV

    php72 tools/wp-cli.phar db export

## Rsync

    rsync -e ssh -rltDvz --delete-after wp-skeleton.beapi.space@wp-skeleton.beapi.space:/home/wp-skeleton.beapi.space/public_html/ /var/www/html/

## Import BDD

    php72 tools/wp-cli.phar db import xxxx.sql

## Script to change URL

    php tools/wp-cli.phar search-replace 'wp-skeleton.beapi.space' 'wp-skeleton.beapi.preprod' --precise --all-tables


