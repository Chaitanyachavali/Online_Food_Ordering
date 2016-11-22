<?php
header('Access-Control-Allow-Origin: *'); //To ajax request from cross domains also
mysql_connect("localhost", "root", ""); //connecting to database
mysql_select_db("of");
$email = $_POST['email'];
if(isset($email))
{
	$query = "select * from of.of_temp_buylist 
					left outer join of.of_items 
					on of_temp_buylist.item_name = of_items.name
					where of_temp_buylist.mail = 'test@gmail.com'";
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
}
else
{
	echo "Invalid";
}
		
?>