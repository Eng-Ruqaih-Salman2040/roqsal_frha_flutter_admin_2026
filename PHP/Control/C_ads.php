<?php

  function checkImge() {
		     if ($_FILES['imge']['name'] === ""){
			 $MSG_imge[0]="";
			 $MSG_imge[1]="default_image.png";
			 $MSG_imge[2]="default";
			  return $MSG_imge;
		 }
		  $MSG_imge[0]="";
		    $imgFile = $_FILES['imge']['name'];
            $tmp_dir = $_FILES['imge']['tmp_name'];
            $imgSize = $_FILES['imge']['size'];
            //مسار حفظ الصورة الشخصية
            $upload_dir = '../../image/ads/';
            $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
            $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
            $MSG_imge[1] = rand(1000, 1000000) . "." . $imgExt;
            if (in_array($imgExt, $valid_extensions)) {
                //   أو  أقل M9 حجم الصورة تكون
                if ($imgSize < 9000000) {
                    move_uploaded_file($tmp_dir, $upload_dir . $MSG_imge[1]);
                } else {
                    $MSG_imge[0] = "Sorry, your file is too large.";
                }
            } else {
                $MSG_imge[0] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
			$MSG_imge[2]="";
 return $MSG_imge;
}
  

if ($_POST) {
	
    // حفظ البيانات
    if (isset($_POST['Add'])) {
		
$note = $_POST['note'];		   
$dt = new DateTime();
$date_create=$dt->format('Y-m-d');
$time_create=$dt->format('H:i:s');


$MSG_imge=checkImge();
            try {
               include '../Model/M_ads.php';

                $M_ads = new M_ads();
               	 if ($MSG_imge[0]==="") {
 $M_ads->Insert_Data($MSG_imge[1],$note,$date_create,$time_create);
 @$Display = $M_ads->Read_Data();
 
       include '../View/ads/index.php';
                } else {
                    echo $MSG_imge[0].'هناك مشكلة في الصورة';
                }
		 } catch (Exception $ex) {
                $ex . getMessage();
            }
    }
   
   if (isset($_POST['Update'])) {
       $id = $_POST['id'];
       $note = $_POST['note'];
      
	   $MSG_imge=checkImge();	   
 include '../Model/M_ads.php';
                $M_ads = new M_ads();
				
    if($MSG_imge[1] != "default_image.png"){

		$sql = "UPDATE `ads` SET  `imge` ='$MSG_imge[1]' ,`note` ='$note'  WHERE `id`= '$id' ";
                    $M_ads->Update_Data($sql);
					    @$Display = $M_ads->Read_Data();
    
    include '../View/ads/index.php';
   	}else{
		$sql = "UPDATE `ads` SET  `note` ='$note' WHERE `id`= '$id' ";
                    $M_ads->Update_Data($sql);
					    @$Display = $M_ads->Read_Data();
    
    include '../View/ads/index.php';
	}
				
			          
    }

    // حذف البيانات
    if (isset($_POST['Delete'])) {
        $id = $_POST['id'];
        try {
            //code...
            include '../Model/M_ads.php';
           $M_ads = new M_ads();
           $M_ads->Delete_Data($id);  
	       @$Display = $M_ads->Read_Data();
	
    include '../View/ads/index.php';
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

} else {

  
      include ('../Model/M_ads.php');
      $M_ads = new M_ads();
      @$Display = $M_ads->Read_Data();
	
    include('../View/ads/index.php');
}