<?php

header('Access-Control-Allow-Origin: *'); //To ajax request from cross domains also

mysql_connect("localhost", "root", ""); //connecting to database
mysql_select_db("of");

$name = $_POST['name'];
$telephone = $_POST['telephone'];
$quantity = $_POST['quantity'];
$remarks = $_POST['remarks'];
$selected_item = $_POST['selected_item'];
$email = $_POST['email'];
$type_taste = $_POST['type_taste'];
$date = date("d/m/Y");
$time = date("h:i:s");
if(isset($email))
{
	$query = "INSERT INTO `of`.`of_temp_buylist` (`mail`, `item_name`, `current_contact`, `quantity`, `remark`, `date_of_add`, `time_of_add`) VALUES ('$email', '$selected_item', '$telephone', $quantity, '$remarks', '$date', '$time')";

	$output = mysql_query($query);

	if($output)
	{
		echo "Valid";
	}
	else
	{
		echo "Not able to update Cart";
	}
}
else
{
	echo "Invalid"
}




?>