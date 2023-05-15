<?php
//connection idkwsadfsdfasdf
$host = 'localhost';
$username = 'root';
$password = 'traxex123lord';
$dbname = 'adet';

$conn = mysqli_connect($host, $username, $password, $dbname);

// connection checker :>
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}