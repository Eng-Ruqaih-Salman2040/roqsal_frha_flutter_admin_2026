<?php

if ($_POST) {
	
    // حفظ البيانات
    if (isset($_POST['Add'])) {
		
    		 $bank_accounts_id = $_POST['bank_accounts_id'];
    		 $account_number = $_POST['account_number'];
    		 
    		 	  if (isset($_POST['statues'])) 
            $statues=1;
            else
            $statues=0;
		

            try {
               include '../Model/M_bank_accounts_user.php';
			   
                $M_bank_accounts_user = new M_bank_accounts_user();
              
 $M_bank_accounts_user->Insert_Data($bank_accounts_id,$account_number,$statues);
 @$Display = $M_bank_accounts_user->Read_Data();
 @$Display_bank_accounts = $M_bank_accounts_user->Read_Data_bank_accounts();
	
       include '../View/bank_accounts_user/index.php';
             
		 } catch (Exception $ex) {
                $ex . getMessage();
            }
    }
   
   if (isset($_POST['Update'])) {
       $id = $_POST['id'];
       $bank_accounts_id = $_POST['bank_accounts_id'];
    		 $account_number = $_POST['account_number'];
    		 
    		 	  if (isset($_POST['statues'])) 
            $statues=1;
            else
            $statues=0;
		   
 include '../Model/M_bank_accounts_user.php';
                $M_bank_accounts_user = new M_bank_accounts_user();
				
		
		$sql = "UPDATE `bank_accounts_user` SET  `bank_accounts_id` ='$bank_accounts_id' ,`account_number`='$account_number'
					,`statues`='$statues' WHERE `id`= '$id' ";
                    $M_bank_accounts_user->Update_Data($sql);
					    @$Display = $M_bank_accounts_user->Read_Data();
    @$Display_bank_accounts = $M_bank_accounts_user->Read_Data_bank_accounts();
	
    include '../View/bank_accounts_user/index.php';
 
				
			          
    }

    // حذف البيانات
    if (isset($_POST['Delete'])) {
        $id = $_POST['id'];
        try {
            //code...
            include '../Model/M_bank_accounts_user.php';
           $M_bank_accounts_user = new M_bank_accounts_user();
           $M_bank_accounts_user->Delete_Data($id);  
	    @$Display = $M_bank_accounts_user->Read_Data();
    @$Display_bank_accounts = $M_bank_accounts_user->Read_Data_bank_accounts();
	
    include '../View/bank_accounts_user/index.php';
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

} else {


      include ('../Model/M_bank_accounts_user.php');
      $M_bank_accounts_user = new M_bank_accounts_user();
 	    @$Display = $M_bank_accounts_user->Read_Data();
    @$Display_bank_accounts = $M_bank_accounts_user->Read_Data_bank_accounts();
	
    include('../View/bank_accounts_user/index.php');
}