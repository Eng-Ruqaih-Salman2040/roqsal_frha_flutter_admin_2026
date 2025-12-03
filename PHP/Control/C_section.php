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
            $upload_dir = '../../image/section/';
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
            $name = $_POST['name'];
	        $sort = $_POST['sort'];
			
			  if (isset($_POST['status'])) 
            $status=1;
            else
            $status=0;
             try {
               include '../Model/M_section.php';
$MSG_imge=checkImge();
                $M_section = new M_section();
               	$M_section->Insert_Data($name,$sort,$MSG_imge[1],$status);
					  
    @$Display = $M_section->Read_Data();
    
    include '../View/section/index.php';
             
				
                   
              
        } catch (Exception $ex) {
                $ex . getMessage();
            }
    }
   
   if (isset($_POST['Update'])) {
	   $id = $_POST['id'];
       $name = $_POST['name'];
        $sort = $_POST['sort'];
		$MSG_imge=checkImge();
       if (isset($_POST['status'])) 
            $status=1;
            else
            $status=0;
          
 include '../Model/M_section.php';
                $M_section = new M_section();
				
				    if($MSG_imge[1] != "default_image.png"){
		
			$sql = "UPDATE `section` SET  `name` ='$name' ,`status`='$status',`sort`='$sort',`image`='$MSG_imge[1]' WHERE `id`= '$id' ";
                    $M_section->Update_Data($sql);
   	}else{
		$sql = "UPDATE `section` SET  `name` ='$name' ,`status`='$status',`sort`='$sort' WHERE `id`= '$id' ";
                    $M_section->Update_Data($sql);
		
	}
	
		
					    @$Display = $M_section->Read_Data();
    
    include '../View/section/index.php';
  }

    // حذف البيانات
    if (isset($_POST['Delete'])) {
        $id = $_POST['id'];
        try {
            //code...
            include '../Model/M_section.php';
           $M_section = new M_section();
           $M_section->Delete_Data($id);  
	       @$Display = $M_section->Read_Data();
  
     include '../View/section/index.php';
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

} else {

    include ('../Model/M_section.php');
    $M_section = new M_section();
    @$Display = $M_section->Read_Data();
    
    include('../View/section/index.php');
}