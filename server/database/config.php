<?php

// constants to be used everywhere
define("SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "records");
define("TABLE_NAME", "details");

try
{
    $conn = new PDO("mysql:host=" . SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    
    // PDO error mode to exception
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo ("Connection made Successfully...");
    
}catch (PDOException $e)
{
    echo ("Error connecting to the database... " . $e -> getMessage());
}


?>