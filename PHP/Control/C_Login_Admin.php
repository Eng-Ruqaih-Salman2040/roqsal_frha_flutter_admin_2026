
<?php

if ($_POST && $_POST['userName'] != "" && $_POST['password'] != "") 
    {

    $username = $_POST['userName'];
    $password = $_POST['password'];

    try {

    include '../Model/M_Login.php';
       $M_Login = new M_Login();
	if ($M_Login->Login_Admin($username,$password)) {
            
      header('Location:../View/index.php');
   }else {
	   
		echo "<script>alert('اسم المستخدم أو كلمة المرور خاطئة');</script>";
			
  //  header('Location:../control/C_Login.php');	
     include '../View/Login_Admin.php';
        }
     
       
    } catch (Exception $ex) {
        //throw $th;
        //  $ex . getMessage();
        // throw new Exception("Error Processing Request", 1);

    }

} else {
    include '../View/Login_Admin.php';
}
