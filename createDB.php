<?php

$host="localhost";

$root="root";
$root_password="";

$user='cmicu';
$pass='crm339';
$db="Element_Sets";

    try {
        $dbh = new PDO("mysql:host=$host", $root, $root_password);

        $dbh->exec("CREATE DATABASE IF NOT EXISTS `$db`;
                CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
                GRANT ALL ON `$db`.* TO '$user'@'localhost';
                FLUSH PRIVILEGES;")
        or die(print_r($dbh->errorInfo(), true));


        $dbh->exec("CREATE TABLE `Element_Sets`.`elements`(
            ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
            NAME VARCHAR( 255 ) NOT NULL,
            SYMBOL VARCHAR( 10 ) NOT NULL,
            FAMILY_SET INT( 11 ),
            ATOMIC_NUMBER VARCHAR( 255 ),
            FOREIGN KEY (FAMILY_SET) REFERENCES `Element_Sets`.`element_sets` (`ID`));")
        or die(print_r($dbh->errorInfo(), true));


    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }
?>
