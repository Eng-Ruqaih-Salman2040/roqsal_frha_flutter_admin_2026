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
}