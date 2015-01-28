#!/bin/sh

php SubmitFeedSample.php 1 > logs_inventory_feeds_sede1/feed_`date +"%m_%d_%Y_%H_%M"`.log
php SubmitFeedSample.php 2 > logs_inventory_feeds_sede2/feed_`date +"%m_%d_%Y_%H_%M"`.log
php SubmitFeedSample.php 3 > logs_inventory_feeds_sede3/feed_`date +"%m_%d_%Y_%H_%M"`.log
php SubmitFeedSample.php 4 > logs_inventory_feeds_sede4/feed_`date +"%m_%d_%Y_%H_%M"`.log
