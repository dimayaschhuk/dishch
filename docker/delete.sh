#!/usr/bin/env bash
docker rm --force --volumes dishch_web_1
docker rm --force --volumes dishch_php_1
docker rm --force --volumes dishch_phpmyadmin_1
docker rm --force --volumes dishch_node_1
docker rm --force --volumes dishch_composer_1
docker rm --force --volumes dishch_mysql_1
docker rm --force --volumes dishch_redis_1