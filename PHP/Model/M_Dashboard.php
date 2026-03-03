<?php

class M_Dashboard
{
   
   private $Database;
    public function __construct()
    {
        $this->connectDB();

    }


    private function connectDB()
    {
        try {
            //code...
            include '../Model/Database.php';
            $vars = '../include/vars.php';
            $this->Database = new Database($vars);
        } catch (\Throwable $th) {
            throw new Exception("Error ", 1);
        }
    }


 public function NumberOf_Users() {

     
$sql="SELECT COUNT(*) AS NumberOfusers FROM users;";
                     
        $result = $this->Database->Connect->query($sql);
            if($row = $result -> fetch_row()){
   
	  
	   return $row[0];
			}
		
  $result->close();
 return 0;
    } 
	
 public function NumberOf_shop() {

     
$sql="SELECT COUNT(*) AS NumberOfusers FROM shop;";
                     
        $result = $this->Database->Connect->query($sql);
            if($row = $result -> fetch_row()){
   
	  
	   return $row[0];
			}
		
  $result->close();
 return 0;
    } 
    public function NumberOf_customers() {
        $sql="SELECT COUNT(*) AS NumberOfusers FROM customers;";
                     
        $result = $this->Database->Connect->query($sql);
            if($row = $result -> fetch_row()){
   
	  
	   return $row[0];
			}
		
  $result->close();
 return 0;


    }
    public function NumberOf_reservations() {
        if (isset($_SESSION['validity']) && $_SESSION['validity'] === "1"){
        $sql="SELECT COUNT(*) AS NumberOfusers FROM reservations;";           
        $result = $this->Database->Connect->query($sql);
            if($row = $result -> fetch_row()){
	            return $row[0];
                $result->close();
                return 0;
            }
			}elseif(isset($_SESSION['validity']) && $_SESSION['validity'] === "0"){
                $shop_id= $_SESSION['getId_User'];
                $sql="SELECT COUNT(*) AS NumberOfusers FROM reservations WHERE shop_id= '$shop_id'";
                $result = $this->Database->Connect->query($sql);
            if($row = $result -> fetch_row()){
	            return $row[0];
                $result->close();
                return 0;
            }
        }
    }
       public function NumberOf_reservations1() {
         if (isset($_SESSION['validity']) && $_SESSION['validity'] === "1"){
         $sql = "SELECT COUNT(*) FROM reservations WHERE reservation_status='1'";
        $result = $this->Database->Connect->query($sql);
            if($row = $result -> fetch_row()){
	            return $row[0];
                $result->close();
                return 0;
            }
			}elseif(isset($_SESSION['validity']) && $_SESSION['validity'] === "0"){
                $shop_id= $_SESSION['getId_User'];
                $sql="SELECT COUNT(*) AS NumberOfusers FROM reservations WHERE shop_id= '$shop_id'AND reservation_status='1' ";
                $result = $this->Database->Connect->query($sql);
            if($row = $result -> fetch_row()){
	            return $row[0];
                $result->close();
                return 0;
            }
        }
    }
       public function NumberOf_reservations2() {
       if (isset($_SESSION['validity']) && $_SESSION['validity'] === "1"){
         $sql = "SELECT COUNT(*) FROM reservations WHERE reservation_status='2'";
        $result = $this->Database->Connect->query($sql);
            if($row = $result -> fetch_row()){
	            return $row[0];
                $result->close();
                return 0;
            }
			}elseif(isset($_SESSION['validity']) && $_SESSION['validity'] === "0"){
                $shop_id= $_SESSION['getId_User'];
                $sql="SELECT COUNT(*) AS NumberOfusers FROM reservations WHERE shop_id= '$shop_id'AND reservation_status='2' ";
                $result = $this->Database->Connect->query($sql);
            if($row = $result -> fetch_row()){
	            return $row[0];
                $result->close();
                return 0;
            }
        }
    }
      public function NumberOf_reservations3() {
if (isset($_SESSION['validity']) && $_SESSION['validity'] === "1"){
         $sql = "SELECT COUNT(*) FROM reservations WHERE reservation_status='3'";
        $result = $this->Database->Connect->query($sql);
            if($row = $result -> fetch_row()){
	            return $row[0];
                $result->close();
                return 0;
            }
			}elseif(isset($_SESSION['validity']) && $_SESSION['validity'] === "0"){
                $shop_id= $_SESSION['getId_User'];
                $sql="SELECT COUNT(*) AS NumberOfusers FROM reservations WHERE shop_id= '$shop_id'AND reservation_status='3' ";
                $result = $this->Database->Connect->query($sql);
            if($row = $result -> fetch_row()){
	            return $row[0];
                $result->close();
                return 0;
            }
        }
}
}
