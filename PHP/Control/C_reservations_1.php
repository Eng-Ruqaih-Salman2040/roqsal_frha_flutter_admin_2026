<?php

if ($_POST) {
	
 
   
   // حذف البيانات
    if (isset($_POST['Delete'])) {
        $id = $_POST['id'];
			   $reservation_status ='0';
        try {
            //code...
            include '../Model/M_reservations.php';
                 $M_reservations = new M_reservations();
				
		$sql = "UPDATE `reservations` SET `reservation_status`='$reservation_status' WHERE `id`= '$id' ";
                    $M_reservations->Update_Data($sql);
					    @$Display = $M_reservations->Read_Data_status1();
  
     include '../View/reservations_1/index.php';
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

} else {

    include ('../Model/M_reservations.php');
    $M_reservations = new M_reservations();
    @$Display = $M_reservations->Read_Data_status1();
    
    include('../View/reservations_1/index.php');
}