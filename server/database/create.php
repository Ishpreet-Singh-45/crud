<?php
/* 
* 
* To create a database and its table with following details
* 
* Database name: "records" -> to change, edit line 16
* Table name: "details" -> to change, edit line 17
*
*/


// constants
define("SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "records");
define("TABLE_NAME", "details");


try
{
    $conn = new PDO("mysql:host=" . SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    
    // set Attribute methods
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo ("Connection made Successfully...");

    /*
    if($stmt = $conn -> query("SHOW DATABASES;"))
    {
        $list = $stmt -> fetchAll(PDO::FETCH_COLUMN);

        // loop through each database
        forEach($list as $database)
        {
            if ($database != DB_NAME)
            {
                // Create Database 
                $query = "CREATE DATABASE " . DB_NAME;
                $conn -> exec($query);
                echo "<br> Database: Database created Successfully...";
            }
            else
                $conn -> select_db(DB_NAME);
                break;
        }   
    }*/
    

    // Create table
    $query = "CREATE TABLE " . TABLE_NAME . "(
        Id INT(3) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Name TEXT(20) NOT NULL,
        Email VARCHAR(50) NOT NULL,
        Phone INT(10) NOT NULL,
        Message VARCHAR(100) NOT NULL)";
    
    $conn -> exec($query);
    echo ("<br> Table: Table created successfully...");
}
catch(PDOException $e)
{
    echo ("<br><br> Error at query: $query <br>" . $e -> getMessage());
}

$conn = null;


?>