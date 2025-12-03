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
            $upload_dir = '../../image/shop/';
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
  
  
  
                
 function checkPdf() {
		   
		  $MSG_pdf[0]="";
		    $imgFile = $_FILES['url_profession_license']['name'];
            $tmp_dir = $_FILES['url_profession_license']['tmp_name'];
            $imgSize = $_FILES['url_profession_license']['size'];
            //مسار حفظ الصورة الشخصية
            $upload_dir = '../../pdf/profession_license/';
		    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
            $valid_extensions = array('pdf');
            $MSG_pdf[1] ="profession_license_".rand(1000, 1000000) . "." . $imgExt;
            if (in_array($imgExt, $valid_extensions)) {
                //   أو  أقل M9 حجم الصورة تكون
                if ($imgSize < 900000000) {
                    move_uploaded_file($tmp_dir, $upload_dir . $MSG_pdf[1]);
                } else {
                    $MSG_pdf[0] = "Sorry, your file is too large.";
                }
            } else {
                $MSG_pdf[0] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
			$MSG_pdf[2]="";
			$MSG_pdf[3]= $imgSize;
			
 return $MSG_pdf;
}
 
if ($_POST) {
if (isset($_POST['login'])) {

  $username = $_POST['userName'];
  $password = $_POST['password'];
  include '../Model/M_Login.php';
       $M_Login = new M_Login();
	if ($M_Login->Login_User($username,$password)) {
            
      header('Location:../View/index.php');
   }else {
	 include '../View/Login_User.php';
        }
}	



if (isset($_POST['Add'])) {
		$user_name = $_POST['user_name'];
    		 $password = $_POST['password'];
    		 $city_id = $_POST['city_id'];
        	 $section_id = $_POST['section_id'];
			 $name = $_POST['name'];
    		 $phone = "";
    		 $email = "";
    		 $price = $_POST['price'];
    		 $description = "";
	   		 $statues=2;					 			 
		  $address = "";

		


$MSG_imge=checkImge();
$MSG_pdf=checkPdf();
          

            try {
             include '../Model/M_shop.php';
			   
                $M_shop = new M_shop();
               	 if ($MSG_imge[0]==="") {
$M_shop->Insert_Data($user_name,$password,$city_id,$name,$phone,$email,$MSG_imge[1],$MSG_pdf[1],$price,$description,$statues,$address,$section_id);
 	
          include '../View/Login_User.php';
                } else {
                    echo $MSG_imge[0].'هناك مشكلة في الصورة';
                }
		 } catch (Exception $ex) {
                $ex . getMessage();
            }
    }
   
if(isset($_POST['Register'])){

    include '../Model/M_shop.php';
			   
    $M_shop = new M_shop();


@$City = $M_shop->Read_Data_city();
@$Display_section = $M_shop->Read_Data_section();



	include '../View/User_Register.php';	
}

} else {
    include '../View/Login_User.php';
}
?>