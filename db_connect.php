<?php 
    $db = new mysqli('localhost','root','','cms');
    if(!$db){
        echo "error in connecting to the database";
    }

?>