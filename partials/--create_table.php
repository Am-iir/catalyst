<?php

if (!isset($credentials) || in_array("", $credentials, true)) {
    die("Please provide hostname,username and password");
}

$hostname = $credentials['hostname'];
$username = $credentials['username'];
$password = $credentials['password'];

$connection = new mysqli($hostname, $username, $password);

if ($connection->connect_error) {

    die("Connection failed: $connection->connect_error");
}

$dbname = "users_db";

$createDbSql = "CREATE DATABASE IF NOT EXISTS $dbname";

if (!$connection->query($createDbSql)) {
    die($connection->error);
}

$connection->close();

$con = new mysqli($hostname, $username, $password, $dbname);

$createTableSql = "CREATE TABLE users( 
 id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(256) NOT NULL,
 surname VARCHAR(256) NOT NULL,
 email VARCHAR(256) UNIQUE
 )";

if (!$con->query($createTableSql)) {
    echo $con->error;
} else {
    echo "Users Table Created Successfully";
}

$con->close();
exit();

