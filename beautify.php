<?php

    $jsonList = $_POST['elements'];

    $list = json_decode($jsonList, true);

/*
name
abriviation
*/

    foreach ($list as $key => $value) {
        foreach ($value as $key1 => $value1) {
            //echo "name: " . $value[$key1]['name'] . "<br>symbol: " . $value[$key1]['abriviation'] . "<br><br>";
            formatElem($value[$key1]['name'], $value[$key1]['abriviation'], $value[$key1]['material'], $key1, $value[$key1]['atomic number']);
        }
    }

    function formatElem($name, $symbol, $material, $index, $atomic){
        echo '<section class="element" name="'. $atomic .'">
                    <h1>'. $symbol .'</h1>
                    <p>'. ($index + 1) .'</p>
                    <p>'. $name .'</p>
                    <p>'. $material .'</p>
                </section>';
    }

?>
