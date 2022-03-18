This code is to be executed on an Ubuntu

The script is written in
PHP version 7.4.18
MY SQL version 8.0.18


For User Upload

Please give executable permission for file by
chmod 755 user_upload.php

To list the available options
./user_upload.php --help

To create table
./user_upload.php -u=[MYSQL username] -p=[MYSQL password] -h=[MYSQL host] --create_table
Example:
./user_upload.php -u=root -p=root -h=localhost --create_table

To insert data from file
./user_upload.php  -u=[MYSQL username] -p=[MYSQL password] -h=[MYSQL host] --file=[filename.extension]
Example:
./user_upload.php -u=root -p=root -h=localhost --file=users.csv

For dry_run with file

./user_upload.php  -u=[MYSQL username] -p=[MYSQL password] -h=[MYSQL host] --file=[filename.extension] --dry_run
Example:
./user_upload.php -u=root -p=root -h=localhost --file=users.csv --dry_run