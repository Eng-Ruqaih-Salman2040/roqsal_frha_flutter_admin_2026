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
            $upload_dir = '../../image/user/';
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
            $password = $_POST['password'];
            $user_name = $_POST['user_name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $note = $_POST['note'];
            $id_validity = 1;
  $dt = new DateTime();
$date_register=$dt->format('Y-m-d');

$MSG_imge=checkImge();
           
          
        
            try {
               include '../Model/M_User.php';

                $M_User = new M_User();
				
	   
               	 if ($MSG_imge[0]==="") {
    $M_User->Insert_Data($password, $user_name, $id_validity, $MSG_imge[1]
					, $phone, $email, $note, $date_register);
					  
    @$Display = $M_User->Read_Data();
    
    include '../View/User/index.php';
                } else {
                    echo $MSG_imge[0].'هناك مشكلة في الصورة';
                }
				
                   
              
        } catch (Exception $ex) {
                $ex . getMessage();
            }
    }
   
   if (isset($_POST['Update'])) {
	   $id = $_POST['id'];
       $password = $_POST['password'];
       $user_name = $_POST['user_name'];
       $phone = $_POST['phone'];
       $email = $_POST['email'];
       $note = $_POST['note'];
$MSG_imge=checkImge();	   
 include '../Model/M_User.php';
                $M_User = new M_User();
				
    if($MSG_imge[1] != "default_image.png"){
		$sql = "UPDATE `users` SET  `password` ='$password' ,`user_name`='$user_name'
					,`phone`='$phone',`email`='$email'
					,`note`='$note' ,`img_user`='$MSG_imge[1]'  WHERE `id_user`= '$id' ";
                    $M_User->Update_Data($sql);
					    @$Display = $M_User->Read_Data();
    
    include '../View/User/index.php';
   	}else{
		$sql = "UPDATE `users` SET  `password` ='$password' ,`user_name`='$user_name'
					,`phone`='$phone',`email`='$email'
					,`note`='$note'   WHERE `id_user`= '$id' ";
                    $M_User->Update_Data($sql);
					    @$Display = $M_User->Read_Data();
    
    include '../View/User/index.php';
	}
				
			          
    }

    // حذف البيانات
    if (isset($_REQUEST['Delete'])) {
        $id = $_REQUEST['id'];
		try {
            //code...
            include '../Model/M_User.php';
           $M_User = new M_User();
           $M_User->Delete_Data($id);  
	       @$Display = $M_User->Read_Data();
  
    include '../View/User/index.php';
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

} else {

    include ('../Model/M_User.php');
    $M_User = new M_User();
    @$Display = $M_User->Read_Data();
    
    include('../View/User/index.php');
}