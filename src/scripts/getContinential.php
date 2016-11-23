<?php
header('Access-Control-Allow-Origin: *'); //To ajax request from cross domains also
mysql_connect("localhost", "root", ""); //connecting to database
mysql_select_db("of");
		$query = "select * from of.of_items where of_items.category = 'continential'";
		$output = mysql_query($query);
		$result_array = array();
		if(mysql_num_rows($output))
		{
			while($row=mysql_fetch_assoc($output))
			{
				$result_array[] = $row;
			}
		}
		echo json_encode($result_array); 
?>