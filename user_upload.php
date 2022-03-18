#!/usr/bin/php -q

<?php

if ($argc > 1) {
    parse_str(implode('&', array_slice($argv, 1)), $_GET);
}

$availableOptions = [
    '--file',
    '--create_table',
    '--dry_run',
    '-u',
    '-p',
    '-h',
    '--help',
];

$insertedOptions = array_keys($_GET);
$validOptions    = array_intersect($availableOptions, $insertedOptions);

if ($argc === 1 || empty($validOptions)) {
    echo "Use --help to get available options \n";
    die();
}

if ($insertedOptions[0] === '--help') {
    require('partials/--help.php');
}

$credentials = [
    'hostname' => $_GET['-h'] ?? "",
    'username' => $_GET['-u'] ?? "",
    'password' => $_GET['-p'] ?? "",

];

if (in_array('--create_table', $insertedOptions, true)) {

    require('partials/--create_table.php');
}

if (in_array('--file', $insertedOptions, true)) {

    require('partials/--file.php');
}






