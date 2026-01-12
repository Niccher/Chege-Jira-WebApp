<?php

$host = 'localhost';
$user = 'root';
$pass = ''; 
$dbName = 'chegecac_chege_os';

echo "Connecting to $dbName at $host as $user...\n";

$mysqli = new mysqli($host, $user, $pass, $dbName);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "Connected successfully.\n";

// Run Migration SQL manually
$sql1 = "ALTER TABLE `users` ADD COLUMN `reset_hash` VARCHAR(255) NULL DEFAULT NULL";
$sql2 = "ALTER TABLE `users` ADD COLUMN `reset_expires_at` DATETIME NULL DEFAULT NULL";

echo "Running SQL: $sql1\n";
try {
    if ($mysqli->query($sql1)) {
        echo "Success: reset_hash column added.\n";
    } else {
        echo "Info: " . $mysqli->error . "\n";
    }
} catch (Exception $e) {
    echo "Info: " . $e->getMessage() . "\n";
}

echo "Running SQL: $sql2\n";
try {
    if ($mysqli->query($sql2)) {
        echo "Success: reset_expires_at column added.\n";
    } else {
        echo "Info: " . $mysqli->error . "\n";
    }
} catch (Exception $e) {
    echo "Info: " . $e->getMessage() . "\n";
}

// Check if columns exist
$result = $mysqli->query("SHOW COLUMNS FROM users LIKE 'reset_%'");
if ($result) {
    echo "Verifying columns:\n";
    while ($row = $result->fetch_assoc()) {
        print_r($row);
    }
}

$mysqli->close();
