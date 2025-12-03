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
 
 include '../Model/M_shop.php';
                $M_shop = new M_shop();
   if (isset($_POST['Update'])) {
	   $id = $_POST['id'];
       $user_name = $_POST['user_name'];
       $password = $_POST['password'];
       $city_id = $_POST['city_id'];
       $name = $_POST['name'];
       $phone = $_POST['phone'];
       $email = $_POST['email'];
       $price = $_POST['price'];
       $description = $_POST['description'];
       $layout_them = $_POST['layout_them'];
       $address = $_POST['address'];
	  $MSG_imge=checkImge();	   

				
    if($MSG_imge[1] != "default_image.png"){
		
		$sql = "UPDATE `shop` SET  `user_name` ='$user_name' ,`password`='$password'
					,`city_id`='$city_id',`name`='$name'
					,`phone`='$phone',`email`='$email' ,`image`='$MSG_imge[1]'
,`price`='$price',`description`='$description' ,`address`='$address',`layout_them`='$layout_them' WHERE `id`= '$id' ";
                    $M_shop->Update_Data($sql);
		}else{
		$sql = "UPDATE `shop` SET  `user_name` ='$user_name' ,`password`='$password'
					,`city_id`='$city_id',`name`='$name'
					,`phone`='$phone',`email`='$email'
,`price`='$price',`description`='$description',`address`='$address',`layout_them`='$layout_them' WHERE `id`= '$id' ";
                    $M_shop->Update_Data($sql);
					

	}
	        $_SESSION['UserName'] =$user_name;
		    $_SESSION['password']  =$password;
            $_SESSION['city_id']  =$categories_id;	
			$_SESSION['name'] =$name;
		    $_SESSION['phone'] =$phone;
		    $_SESSION['email'] =$email;
		    $_SESSION['price'] =$price;
		    $_SESSION['description'] =$description;
     		$_SESSION['layout_them'] =$layout_them;
		    $_SESSION['address'] =$address;
			
   }
	@$city = $M_shop->Read_Data_city();
	
    include('../View/Profile_User.php');
