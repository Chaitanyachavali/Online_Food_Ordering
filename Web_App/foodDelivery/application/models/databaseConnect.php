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

   //get current Orders
   public function getCurrentOrders()
   {
   	$u = "select * from of.of_purchases where of_purchases.`status` != 'delivered'";
   	$query = $this->db->query($u);
   	return $query->result();
   }

   //get User's name
   public function getUserName($mail)
   {
      $u = "select name from of.of_users where of_users.mail = '$mail'";
      $query = $this->db->query($u);
      foreach ($query->result() as $key) {
          return $key->name;
      }
   }

   //get Item Name
   public function getItemName($id)
   {
      $u = "select name from of.of_items where of_items.item_id = $id";
      $query = $this->db->query($u);
      foreach ($query->result() as $key) {
          return $key->name;
      }
   }

   //get Delivered Orders
   public function getDeliveredOrders()
   {
   	$u = "select * from of.of_purchases where of_purchases.`status` = 'delivered'";
   	$query = $this->db->query($u);
   	return $query->result();
   }

}



?>
