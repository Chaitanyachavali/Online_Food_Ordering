<?php
header('Access-Control-Allow-Origin: *'); //To ajax request from cross domains also
mysql_connect("localhost", "root", ""); //connecting to database
mysql_select_db("of");
$buy_id = $_POST['buy_id'];
		if(isset($buy_id))
		{
			$query = "delete from of.of_temp_buylist where of_temp_buylist.buy_id = $buy_id";
			$output = mysql_query($query);
		}
		else
			{
				echo "Invalid";
			}
?>