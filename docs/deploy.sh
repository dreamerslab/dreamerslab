#!/bin/bash
# Copy this script to $HOME and run it

path=/srv/www/dreamerslab.com
tmp=/srv/www/tmp

echo 'Cloning repo from github...'
git clone git@github.com:dreamerslab/dreamerslab.git $tmp
echo '...done!'
echo ''

echo 'Cloning configs...'
cp -R configs/dreamerslab/ci $tmp/app/config
cp configs/dreamerslab/wp/wp-config.php $tmp/blog/wp-config.php
echo '...done!'
echo ''

echo 'Switching configs to production mode...'
mv $tmp/app/config/database.prod.php $tmp/app/config/database.php
mv $tmp/app/config/carabiner.prod.php $tmp/app/config/carabiner.php
mv $tmp/app/config/config.prod.php $tmp/app/config/config.php
mv $tmp/app/core/MY_Controller.prod.php $tmp/app/core/MY_Controller.php
mv $tmp/app/views/common/config.prod.yml $tmp/app/views/common/config.yml
mv $tmp/public/index.prod.php $tmp/public/index.php
echo '...done!'
echo ''

echo 'Enable cache write permission...'
sudo chown -R www-data:www-data $tmp/app/cache
sudo chown -R www-data:www-data $tmp/app/logs
sudo chown -R www-data:www-data $tmp/public/cache
echo '...done!'
echo ''

echo 'Prepare for wp caching plugins...'
sudo mkdir -p $tmp/blog/wp-content/cache/hyper-cache/
sudo mkdir -p $tmp/blog/wp-content/tmp/
sudo mkdir -p $tmp/blog/wp-content/tmp/links/
sudo mkdir -p $tmp/blog/wp-content/tmp/options/
sudo mkdir -p $tmp/blog/wp-content/tmp/posts/
sudo mkdir -p $tmp/blog/wp-content/tmp/terms/
sudo mkdir -p $tmp/blog/wp-content/tmp/users/
sudo chown -R www-data:www-data $tmp/blog
echo '...done!'
echo ''

echo 'Backing up old version...'
mv $path $path`date +"%Y%m%d%H%M%S"`
echo '...done!'
echo ''

echo 'Switch to latest version...'
mv $tmp $path
echo '...done!'
echo ''