<?php

include 'atoms.php';

$Em = getAtomicComposition(112, 'Em');
$Pf = getAtomicComposition(96, 'Pf');

$element1 = getLastShell($Em);
$element2 = getLastShell($Pf);

echo $element1 . "<br>";
echo cvsComposition($Em) . "<br>";
echo array_sum($Em) . "<br>";
echo getAvailableSlots($Em) . "<br><br>";

echo $element2 . "<br>";
echo cvsComposition($Pf) . "<br>";
echo array_sum($Pf) . "<br>";
echo getAvailableSlots($Pf) . "<br><br>";

echo "Reaction Results <br><br>";
react($Em, $Pf);

function react($atom1, $atom2){
    $outerShell1 = getLastShell($atom1);
    $outerShell2 = getLastShell($atom2);
    $spareSlots1 = getAvailableSlots($atom1);
    $spareSlots2 = getAvailableSlots($atom2);

    if($outerShell1 <= $spareSlots2){
        if($outerShell1 == $spareSlots2){
            echo "Full Reaction possible";
        } else {
            echo "Partial Reaction possible <br>Slots left in molecule: " . ($spareSlots2 - $outerShell1);
        }
    } elseif ($outerShell2 <= $spareSlots1){
        if($outerShell2 == $spareSlots1){
            echo "Full Reaction possible";
        } else {
            echo "Partial Reaction possible <br>Slots left in molecule: " . ($spareSlots1 - $outerShell2);
        }
    } else {
        echo "No possible reaction";
    }

}

?>
