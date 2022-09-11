<?php
require_once("database/entities/names.php");

$names = new names();
$names->firstName=$_POST['fname'];
$names->lastName=$_POST['lname'];
echo "first name :-".$names->firstName."<br>";
echo "last name :-".$names->lastName."<br>";
echo "fullname :-".$names->fullname();
?>
<html>
	<form action="print.php" method="post">
	fisrt name:-<input type="text" name="fname">
	last name:-<input type="text" name="lname">
	<input type="submit" name="submit">
	</form>
</html>