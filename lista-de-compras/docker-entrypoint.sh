#!/bin/bash

# Limpe o cache do Apache
rm -rf /var/www/html/storage/framework/views/*
rm -rf /var/www/html/storage/framework/cache/*

# Limpe o cache do PHP
rm -rf /var/www/html/storage/framework/sessions/*
rm -rf /var/www/html/storage/framework/cache/data/*

# Inicie o Apache
apache2-foreground