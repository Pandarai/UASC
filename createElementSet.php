<?php

    $seed = $_POST['seed'];

    $names = $_POST['names'];

    $atomic_numbers = $_POST['atomic'];

    $symbols = $_POST['symbols'];

    $host='localhost';
    $user='cmicu';
    $pass='crm339';


    try {
        $dbh = new PDO("mysql:host=$host", $user, $pass);

        $insert_query = "INSERT INTO `Element_Sets`.`element_sets` (SEED) VALUES ('$seed');";

        $query = $dbh->prepare($insert_query);
        $query->execute();

        $stmt = $dbh->query("SELECT ID FROM `Element_Sets`.`element_sets` WHERE SEED = '$seed';");

        $row = $stmt->fetchObject();

        foreach ($names as $key => $value) {
            $insert_query = "INSERT INTO `Element_Sets`.`elements` (NAME, SYMBOL, FAMILY_SET, ATOMIC_NUMBER) VALUES ('$names[$key]', '$symbols[$key]', '$row->ID', '$atomic_numbers[$key]');";

            $query = $dbh->prepare($insert_query);
            $query->execute();
        }

    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }

    echo $seed;

?>
