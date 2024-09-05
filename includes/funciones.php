<?php 
     function debugear($variable){
        echo '<pre>';
        var_dump($variable);
        echo '</pre>';
     }


// escapa o sanitizar el html
function s($html) : string{
    $s = htmlspecialchars($html);
    return $s;
}
?>