<?php

if ($_POST) {
	
    // حفظ البيانات
    if (isset($_POST['Add'])) {
		
$name = $_POST['name'];	
$email = $_POST['email'];	
$subject = $_POST['subject'];	
$message = $_POST['message'];	
  if (isset($_POST['statues'])) 
            $statues=1;
            else
            $statues=0;
		
$dt = new DateTime();
$date_create=$dt->format('Y-m-d');
$time_create=$dt->format('H:i:s');

            try {
               include '../Model/M_technical_support.php';

                $M_technical_support = new M_technical_support();
               	 if ($MSG_imge[0]==="") {
 $M_technical_support->Insert_Data($name,$email,$subject,$message,$statues,$date_create,$time_create);
 @$Display = $M_technical_support->Read_Data();
 
       include '../View/technical_support/index.php';
                } else {
                    echo $MSG_imge[0].'هناك مشكلة في الصورة';
                }
		 } catch (Exception $ex) {
                $ex . getMessage();
            }
    }
   

    // حذف البيانات
    if (isset($_POST['Delete'])) {
        $id = $_POST['id'];
		  
        try {

	
	        $status=1;	   
 include '../Model/M_technical_support.php';
                $M_technical_support = new M_technical_support();
		$sql = "UPDATE `technical_support` SET `status` ='$status' WHERE `id`= '$id' ";
    $M_technical_support->Update_Data($sql);
	@$Display = $M_technical_support->Read_Data();
    include('../View/technical_support/index.php');
    
    } catch (\Throwable $th) {
            //throw $th;
        }
    }

} else {

  
      include ('../Model/M_technical_support.php');
      $M_technical_support = new M_technical_support();
      @$Display = $M_technical_support->Read_Data();
	
    include('../View/technical_support/index.php');
}