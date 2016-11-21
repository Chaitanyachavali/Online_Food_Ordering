<?php
header('Access-Control-Allow-Origin: *'); //To ajax request from cross domains also
mysql_connect("localhost", "root", ""); //connecting to database
mysql_select_db("of");
$selected_item = $_POST['selected_item'];
		if(isset($selected_item))
		{
			$query = "select category from of.of_items where of_items.name = '$selected_item'";
			$output = mysql_query($query);
			$row = mysql_fetch_array($output);
			echo json_encode($row);
		}
		else
			{
				echo "Invalid";
			}
?>