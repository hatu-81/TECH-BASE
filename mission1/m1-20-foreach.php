<?php
    $names = array("Ken","Alice","Judy","BOSS","Bob");
    
    //foreachでループを起こす
    foreach ($names as $name){
        if ($name == "BOSS"){
            echo "Good morning $name!<br>";
        }else {
            echo "Hi! $name<br>";
        }
    }
    
    //whileでループを起こす
    $i = 0;
    $count = count($names);
    
    while ($i < $count) {
        $name = $names[$i];
        echo $name . " is at work. <br>";
        
        $i++;
    }
?>