<?php

if ($_POST) {
	
    // حفظ البيانات
    if (isset($_POST['Add'])) {
            $name = $_POST['name'];
			  if (isset($_POST['statues'])) 
            $statues=1;
            else
            $statues=0;
             try {
               include '../Model/M_City.php';

                $M_City = new M_City();
               	$M_City->Insert_Data($name, $statues);
					  
    @$Display = $M_City->Read_Data();
    
    include '../View/City/index.php';
             
				
                   
              
        } catch (Exception $ex) {
                $ex . getMessage();
            }
    }
   
   if (isset($_POST['Update'])) {
	   $id = $_POST['id'];
       $name = $_POST['name'];
       if (isset($_POST['statues'])) 
            $statues=1;
            else
            $statues=0;
          
 include '../Model/M_City.php';
                $M_City = new M_City();
				
		$sql = "UPDATE `city` SET  `name` ='$name' ,`statues`='$statues' WHERE `id`= '$id' ";
                    $M_City->Update_Data($sql);
					    @$Display = $M_City->Read_Data();
    
    include '../View/City/index.php';
  }

    // حذف البيانات
    if (isset($_POST['Delete'])) {
        $id = $_POST['id'];
        try {
            //code...
            include '../Model/M_City.php';
           $M_City = new M_City();
           $M_City->Delete_Data($id);  
	       @$Display = $M_City->Read_Data();
  
     include '../View/City/index.php';
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

} else {

    include ('../Model/M_City.php');
    $M_City = new M_City();
    @$Display = $M_City->Read_Data();
    
    include('../View/City/index.php');
}