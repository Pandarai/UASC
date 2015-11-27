<?php

function getAtomicComposition($atomicNumber, $symbol){

$shells = [4,8,8,8,16,16,32,32,64,128];
$remaining = $atomicNumber;
$atomshell = [];
for($i = 0; $i < count($shells); $i++){
    if($remaining == 0){
        break;
    }
    elseif($remaining < $shells[$i]){
        $atomshell[$i] = $remaining;
        $remaining = 0;
    } else {
        $atomshell[$i] = $shells[$i];
        $remaining = $remaining - $shells[$i];
    }
}

return $atomshell;

}

function cvsComposition($shells){
    foreach ($shells as $key => $value) {
        if($key == count($shells)-1){
            echo $shells[$key];
        } else {
            echo $shells[$key] . ", ";
        }
    }
}

function getLastShell($atom){
    return $atom[count($atom) - 1];
}

function getAvailableSlots($atom){
    $shells = [4,8,8,8,16,16,32,32,64,128];
    return $shells[count($atom) - 1] - getLastShell($atom);
}

?>
