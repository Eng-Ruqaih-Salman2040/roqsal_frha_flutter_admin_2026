<?php
       
if ($_POST) {
	
    // حفظ البيانات
    if (isset($_POST['Add'])) {
            $note = $_POST['note'];
          $dt = new DateTime();
$date_create=$dt->format('Y-m-d');
$time_create=$dt->format('H:i: a');
               include '../Model/M_notifications.php';
      $M_notifications = new M_notifications();
	 $M_notifications->Insert_Data($note,$date_create,$time_create);
					  
    @$Display = $M_notifications->Read_Data();
    
    include '../View/notifications/index.php';
   
    }
   
   if (isset($_POST['Update'])) {
	   $id = $_POST['id'];
    $note = $_POST['note'];
         
 include '../Model/M_notifications.php';
                $M_notifications = new M_notifications();
				
		$sql = "UPDATE `notifications` SET  `note` ='$note'  WHERE `id`= '$id' ";
                    $M_notifications->Update_Data($sql);
					    @$Display = $M_notifications->Read_Data();
    
    include '../View/notifications/index.php';
  
				
			          
    }

    // حذف البيانات
    if (isset($_REQUEST['Delete'])) {
        $id = $_REQUEST['id'];
		try {
            //code...
            include '../Model/M_notifications.php';
           $M_notifications = new M_notifications();
           $M_notifications->Delete_Data($id);  
	       @$Display = $M_notifications->Read_Data();
  
    include '../View/notifications/index.php';
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

} else {

    include ('../Model/M_notifications.php');
    $M_notifications = new M_notifications();
    @$Display = $M_notifications->Read_Data();
    
    include('../View/notifications/index.php');
}