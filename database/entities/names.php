<?php
class names{
	public $firstName="abc";
	public $lastName="efg";
	public function fullName()
	{
		return $this->firstName." ".$this->lastName;
	}
}
?>