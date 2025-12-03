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
  
   if (isset($_POST['Update'])) {
	   $id = $_POST['id'];
       $password = $_POST['password'];
       $user_name = $_POST['user_name'];
       $phone = $_POST['phone'];
       $email = $_POST['email'];
       $note = $_POST['note'];
	   $layout_them = $_POST['layout_them'];
	   
	   
$MSG_imge=checkImge();	   
 include '../Model/M_User.php';
                $M_User = new M_User();
	if($MSG_imge[1] != "default_image.png"){
		$sql = "UPDATE `users` SET  `password` ='$password' ,`user_name`='$user_name'
					,`phone`='$phone',`email`='$email'
					,`note`='$note' ,`layout_them`='$layout_them',`img_user`='$MSG_imge[1]'  WHERE `id_user`= '$id' ";
                    $M_User->Update_Data($sql);
					
            $_SESSION['getImage_User']  =$MSG_imge[1];
	}else{
		$sql = "UPDATE `users` SET  `password` ='$password' ,`user_name`='$user_name'
					,`phone`='$phone',`email`='$email'
					,`note`='$note',`layout_them`='$layout_them'   WHERE `id_user`= '$id' ";
                    $M_User->Update_Data($sql);
					
    }
		    $_SESSION['password'] =$password;
		    $_SESSION['UserName'] =$user_name;
		    $_SESSION['phone'] =$phone;
		    $_SESSION['email'] =$email;
		    $_SESSION['note'] =$note;
			$_SESSION['layout_them'] =$layout_them;
//			 echo "<script> alert(".$_POST['layout_them'].");</script>";         
    }
	// session_destroy();
	
	 //header('Location:dashboard_Admin.php?page1=User');

	//header("Refresh:0; url=dashboard_Admin.php?page1=Profile");
    include('../View/Profile_Admin.php');
    
 
