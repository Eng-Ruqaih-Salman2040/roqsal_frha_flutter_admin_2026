<?php

session_start();
class M_Login
{

    private $id_user;
    private $username;
    private $userpassword;
    private $img_user;
    
    private $Database;

    public function __construct()
    {
  //connect db
        $this->connectDB();
        //getdata

    }

  
    private function connectDB()
    {
        try {
            //code...
            require '../Model/Database.php';
            $vars = '../include/vars.php';
            $this->Database = new Database($vars);

        } catch (\Throwable $th) {
            //   throw new Exception("Error ", 1);

        }

    }

     public function Login_Admin($user_name, $passowrd) {

     
$sql="SELECT * FROM users WHERE  user_name='$user_name' and 		password='$passowrd' ";
                     
        $result = $this->Database->Connect->query($sql);
            if($row = $result -> fetch_row()){
   
	  
            $_SESSION['getId_User'] =$row[0];
		    $_SESSION['password'] =$row[1];
		    $_SESSION['UserName']  =$row[2];
            $_SESSION['getImage_User']  =$row[3];	
		    $_SESSION['phone'] =$row[4];
		    $_SESSION['email'] =$row[5];
		    $_SESSION['note'] =$row[6];
		    $_SESSION['layout_them'] =$row[11]; // layout_them is column index 11 in users table
			$_SESSION['validity'] ="1";
			 
	   return true;
			}
		
  $result->close();
 return false;
    }

     public function Login_User($user_name, $passowrd) {

     
$sql="SELECT * FROM shop WHERE  user_name='$user_name' and password='$passowrd'";
                     
        $result = $this->Database->Connect->query($sql);
            if($row = $result -> fetch_row()){
	
   if($row[11]==="0"){
	   	echo "<script>alert('لم يتم مراجعة ملف ترخيض مزاولة المهنه بعد للاستفسار يرجى الاتصال برقم 777777 وشكرا');</script>";
	 return false;    
   }
	 if($row[11]==="0"){
			echo "<script>alert('تم ايقاف حسابك للاستفسار يرجى الاتصال برقم 77777 وشكرا');</script>";
	 
 return false; 
	 }
     $_SESSION['getId_User'] =$row[0];
            // $_SESSION['shop_id'] =$row[0];
            // $_SESSION['shop_id'] = $row[0];
		    $_SESSION['UserName'] =$row[1];
		    $_SESSION['password']  =$row[2];
			$_SESSION['name'] =$row[3];
            $_SESSION['city_id']  =$row[4];	
            $_SESSION['address']  =$row[5];	
            $_SESSION['email']  =$row[6];	
            $_SESSION['phone']  =$row[7];	
            $_SESSION['getImage_User']  =$row[8];	
            $_SESSION['description']  =$row[9];	
            $_SESSION['price']  =$row[10];	
            $_SESSION['statues']  =$row[11];	
            $_SESSION['layout_them']  =$row[12];	
            $_SESSION['viewer']  =$row[13];	
            $_SESSION['profession_license']  =$row[14];			
            $_SESSION['section_id']  =$row[15];			
            $_SESSION['validity'] ="0";
		 	
	   return true;
			}
		
  $result->close();
  	echo "<script>alert('اسم المستخدم أو كلمة المرور خاطئة');</script>";
	  
 return false;
    }

	 

    public function closeDB()
    {

        $this->Database->Connect->close();
    }

}