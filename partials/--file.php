<?php

if (!isset($credentials) || in_array("", $credentials, true)) {
    die("Please provide hostname,username and password");
}

$csvFile = $_GET['--file'];

if (empty($csvFile)) {
    die('Please provide file');
}

$rows = [];

try {

    if (!file_exists($csvFile)) {
        throw new \RuntimeException('File Not Found');
    }

    $file = fopen($csvFile, "r");

    if (!$file) {
        throw new \RuntimeException('File Open Failed');
    }

    while (($data = fgetcsv($file)) !== false) {
        $rows[] = $data;
    }

    fclose($file);

} catch (RuntimeException $ex) {
    die($ex->getMessage());
}

array_shift($rows);


$con = new mysqli($credentials['hostname'], $credentials['username'], $credentials['password'], 'users_db');


foreach ($rows as $row) {

    $email = $row[2];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        fwrite(STDOUT, "Invalid Email: $email \n");

        continue;
    }

    $insertData = [];

    $csvData['name']    = ucfirst($row['0']);
    $csvData['surname'] = ucfirst($row['1']);
    $csvData['email']   = strtolower($email);


    foreach ($csvData as $index => $value) {
        $insertData[$index] = quoteSmart($value);
    }

    $implodedValues = implode(', ', $insertData);

    $insertQuery = sprintf("INSERT INTO `users` (`name`, `surname`, `email`)  VALUES (%s) 
    on duplicate key update `name` = %s, `surname`=%s", $implodedValues, $insertData['name'], $insertData['surname']);

    if (!isset($_GET['--dry_run'])) {
        $success = $con->query($insertQuery);

        if (!$success) {
            fwrite(STDOUT, "Insert Failed: $con->error \n");
        }
    }
}

$con->close();

function quoteSmart($value)
{
    global $con;

    if (!is_numeric($value)) {

        $value = "'".$con->real_escape_string($value)."'";
    }

    return $value;
}