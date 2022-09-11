<?php
require_once("database/entities/names.php");

$names = new names();
echo $names->fullname();
?>