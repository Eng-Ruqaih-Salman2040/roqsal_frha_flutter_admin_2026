<?php

if ($_POST) {
	
 
   
   if (isset($_POST['Update'])) {
	   $id = $_POST['id'];
       $booking_time = $_POST['booking_time'];
	   $reservation_status ='1';
	   
  
          
 include '../Model/M_reservations.php';
                $M_reservations = new M_reservations();
				
		$sql = "UPDATE `reservations` SET  `booking_time` ='$booking_time' ,`reservation_status`='$reservation_status' WHERE `id`= '$id' ";
                    $M_reservations->Update_Data($sql);
					    @$Display = $M_reservations->Read_Data_status0();
    
    include '../View/reservations/index.php';
  }

    // حذف البيانات
    if (isset($_POST['Accept'])) {
        $id = $_POST['id'];
			   $reservation_status ='1';
        try {
            //code...
            include '../Model/M_reservations.php';
                 $M_reservations = new M_reservations();
				
		$sql = "UPDATE `reservations` SET `reservation_status`='$reservation_status' WHERE `id`= '$id' ";
                    $M_reservations->Update_Data($sql);
					    @$Display = $M_reservations->Read_Data_status0();
  
     include '../View/reservations/index.php';
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
	    if (isset($_POST['Delete'])) {
        $id = $_POST['id'];
			   $reservation_status ='2';
        try {
            //code...
            include '../Model/M_reservations.php';
                 $M_reservations = new M_reservations();
				
		$sql = "UPDATE `reservations` SET `reservation_status`='$reservation_status' WHERE `id`= '$id' ";
                    $M_reservations->Update_Data($sql);
					    @$Display = $M_reservations->Read_Data_status0();
  
     include '../View/reservations/index.php';
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

} else {

    include ('../Model/M_reservations.php');
    $M_reservations = new M_reservations();
    @$Display = $M_reservations->Read_Data_status0();
    
    include('../View/reservations/index.php');
}