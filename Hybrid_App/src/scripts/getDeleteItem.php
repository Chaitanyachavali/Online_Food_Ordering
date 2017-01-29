<?php
header('Access-Control-Allow-Origin: *'); //To ajax request from cross domains also
mysql_connect("localhost", "root", ""); //connecting to database
mysql_select_db("of");
$email = $_POST['email'];
$buy_id = $_POST['buy_id'];
		if(isset($email))
		{
			$query = "select * from of.of_temp_buylist 
						left outer join of.of_items 
						on of_temp_buylist.item_name = of_items.name
						where of_temp_buylist.mail = '$email' and buy_id = $buy_id";
			$output = mysql_query($query);
			$row = mysql_fetch_array($output);
			echo json_encode($row);
		}
		else
			{
				echo "Invalid";
			}
?>