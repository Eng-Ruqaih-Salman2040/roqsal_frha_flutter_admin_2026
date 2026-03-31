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
            $upload_dir = '../../image/bank/';
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
            $account_name = $_POST['account_name'];
            $number_bank_accounts= $_POST['number_bank_accounts'];
$MSG_imge=checkImge();
  
           
          
        
            try {
               include '../Model/M_bank_accounts.php';

                $M_bank_accounts = new M_bank_accounts();
		 
               	 if ($MSG_imge[0]==="") {
    $M_bank_accounts->Insert_Data($MSG_imge[1], $account_name,$number_bank_accounts);
					  
    @$Display = $M_bank_accounts->Read_Data();
    
    include '../View/bank_accounts/index.php';
                } else {
                    echo $MSG_imge[0].'هناك مشكلة في الصورة';
                }
				
                   
              
        } catch (Exception $ex) {
                $ex . getMessage();
            }
    }
   
    if (isset($_POST['Update'])) {
        $id = $_POST['id'];
        $account_name = $_POST['account_name'];
        $number_bank_accounts = $_POST['number_bank_accounts'];   
        
        include '../Model/M_bank_accounts.php';
        $M_bank_accounts = new M_bank_accounts();
        
        // التحقق من وجود صورة جديدة
        if (isset($_FILES['imge']) && $_FILES['imge']['name'] != "") {
            // توجد صورة جديدة - نتحقق منها ونرفعها
            $MSG_imge = checkImge();
            
            if ($MSG_imge[0] == "") {
                // لا يوجد خطأ في الصورة
                $sql = "UPDATE `bank_accounts` SET  
                        `account_name` = '$account_name', 
                        `imge` = '$MSG_imge[1]', 
                        `number_bank_accounts` = '$number_bank_accounts' 
                        WHERE `id` = '$id'";
                
                // ✅ للتشخيص - أضف هذا سطر مؤقتاً
                echo "<!-- استعلام التحديث مع الصورة: $sql -->";
                
                $M_bank_accounts->Update_Data($sql);
            } else {
                // يوجد خطأ في الصورة
                echo "<script>alert('" . $MSG_imge[0] . "');</script>";
                // نكمل بدون تحديث الصورة
                $sql = "UPDATE `bank_accounts` SET  
                        `account_name` = '$account_name', 
                        `number_bank_accounts` = '$number_bank_accounts' 
                        WHERE `id` = '$id'";
                
                // ✅ للتشخيص - أضف هذا سطر مؤقتاً
                echo "<!-- استعلام التحديث بدون صورة (بعد خطأ الصورة): $sql -->";
                
                $M_bank_accounts->Update_Data($sql);
            }
        } else {
            // لا توجد صورة جديدة - تحديث بدون صورة
            $sql = "UPDATE `bank_accounts` SET  
                    `account_name` = '$account_name', 
                    `number_bank_accounts` = '$number_bank_accounts' 
                    WHERE `id` = '$id'";
            
            // ✅ للتشخيص - أضف هذا سطر مؤقتاً
            echo "<!-- استعلام التحديث بدون صورة: $sql -->";
            
            $M_bank_accounts->Update_Data($sql);
        }
        
        @$Display = $M_bank_accounts->Read_Data();
        include '../View/bank_accounts/index.php';
    }            

    // حذف البيانات
    if (isset($_REQUEST['Delete'])) {
        $id = $_REQUEST['id'];
		try {
            //code...
            include '../Model/M_bank_accounts.php';
           $M_bank_accounts = new M_bank_accounts();
           $M_bank_accounts->Delete_Data($id);  
	       @$Display = $M_bank_accounts->Read_Data();
  
    include '../View/bank_accounts/index.php';
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

} else {

    include ('../Model/M_bank_accounts.php');
    $M_bank_accounts = new M_bank_accounts();
    @$Display = $M_bank_accounts->Read_Data();
    
    include('../View/bank_accounts/index.php');
}