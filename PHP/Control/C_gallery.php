<?php

if ($_POST) {
	
    // حفظ البيانات
    if (isset($_POST['Add'])) {
		// File upload configuration 
     $targetDir = '../../image/gallery/';
    $allowTypes = array('jpg','png','jpeg','gif'); 
    
    $statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = ''; 
    $fileNames = array_filter($_FILES['files']['name']); 
    if(!empty($fileNames)){ 
        foreach($_FILES['files']['name'] as $key=>$val){ 
            // File upload path 
            $fileName = basename($_FILES['files']['name'][$key]); 
            $targetFilePath = $targetDir . $fileName; 
             
            // Check whether file type is valid 
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to server 
                if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){ 
                    // Image db insert sql 
					  $shop_id=$_SESSION['getId_User'];
                    $insertValuesSQL .= "('".$shop_id."','".$fileName."', NOW()),"; 
					
                }else{ 
                    $errorUpload .= $_FILES['files']['name'][$key].' | '; 
                } 
            }else{ 
                $errorUploadType .= $_FILES['files']['name'][$key].' | '; 
            } 
        } 
         
        // Error message 
        $errorUpload = !empty($errorUpload)?'Upload Error: '.trim($errorUpload, ' | '):''; 
        $errorUploadType = !empty($errorUploadType)?'File Type Error: '.trim($errorUploadType, ' | '):''; 
        $errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType; 
         
        if(!empty($insertValuesSQL)){ 
            $insertValuesSQL = trim($insertValuesSQL, ','); 
            // Insert image file name into database 
			
               include '../Model/M_gallery.php';

                $M_gallery = new M_gallery();
               	$M_gallery->Insert_Data($insertValuesSQL);
					  
    @$Display = $M_gallery->Read_Data();
    
    include '../View/gallery/index.php';
         
        }else{ 
            $statusMsg = "Upload failed! ".$errorMsg; 
        } 
    }else{ 
        $statusMsg = 'Please select a file to upload.'; 
    } 
            
			//  if (isset($_POST['statues'])) 
          //  $statues=1;
         //   else
        //    $statues=0;
        		
   
    }
   
   if (isset($_POST['Update'])) {
	   $id = $_POST['id'];
       $name = $_POST['name'];
       if (isset($_POST['status'])) 
            $status=1;
            else
            $status=0;
          
 include '../Model/M_gallery.php';
                $M_gallery = new M_gallery();
				
		$sql = "UPDATE `gallery` SET `status`='$status' WHERE `id`= '$id' ";
                    $M_gallery->Update_Data($sql);
					    @$Display = $M_gallery->Read_Data();
    
    include '../View/gallery/index.php';
  }

    // حذف البيانات
    if (isset($_POST['Delete'])) {
        $id = $_POST['id'];
        try {
            //code...
            include '../Model/M_gallery.php';
           $M_gallery = new M_gallery();
           $M_gallery->Delete_Data($id);  
	       @$Display = $M_gallery->Read_Data();
  
     include '../View/gallery/index.php';
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

} else {

    include ('../Model/M_gallery.php');
    $M_gallery = new M_gallery();
    @$Display = $M_gallery->Read_Data();
    
    include('../View/gallery/index.php');
}