<?php
 class databaseConnect extends CI_Model
{

   public function __construct()
   {
          parent::__construct();
   }

   //checking if user Exists
   public function checkUserExit($username, $password)
   {
   	$u = "select count(*) as count from of.of_admins where of_admins.username = '$username' and of_admins.password = '$password'";
     $query = $this->db->query($u);
     return $query->result()[0]->count;
   }

   //Getting User details
   public function getUserDetails($username)
   {
   	$u = "select * from of.of_admins where of_admins.username = '$username'";
   	$query = $this->db->query($u);
   	return $query->result()[0];
   }

}



?>
