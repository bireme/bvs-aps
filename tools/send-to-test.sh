#!/bin/bash

serv="crisfoto"
ssh="ssh $serv"
root="/home/moa/project/bvsaps"

rsync -rv $root/htdocs/wp-content/* $serv:~/webapps/moacirmoda/tmp/bvsaps/wp-content
rsync -rv $root/git/wpdecs/wpdecs/* $serv:~/webapps/moacirmoda/tmp/bvsaps/wp-content/plugins/wpdecs

cd $root/htdocs/
wp db export /tmp/bvsaps-local.sql

wp search-replace bvsaps.dev moacirmoda.com/tmp/bvsaps
wp search-replace home/moa/project/bvsaps/htdocs /home/crisfoto/webapps/moacirmoda/tmp/bvsaps
wp db export /tmp/bvsaps.sql

wp db import /tmp/bvsaps-local.sql
rm /tmp/bvsaps-local.sql

rsync -rav /tmp/bvsaps.sql $serv:~/webapps/moacirmoda/tmp/bvsaps/
$ssh "mysql -u tmp -pmoa00moa bvsaps < ~/webapps/moacirmoda/tmp/bvsaps/bvsaps.sql && rm -rfv ~/webapps/moacirmoda/tmp/bvsaps/bvsaps.sql"

rm /tmp/bvsaps.sql
