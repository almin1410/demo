<?php
require_once("database/entities/names.php");

$names = new names();
echo "first name :-".$names->firstName."<br>";
echo "last name :-".$names->lastName."<br>";
echo "fullname :-".$names->fullname();
?>
