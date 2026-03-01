<?php

class M_bank_accounts_user
{
	private $Database;
    public function __construct()
    {
        $this->connectDB();

    } 
    private function connectDB()
    {
		echo '<script src="../../app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>';
        try {
            //code...
            include '../Model/Database.php';
            $vars = '../include/vars.php';
            $this->Database = new Database($vars);
        } catch (\Throwable $th) {
            throw new Exception("Error ", 1);
        }
    }

    public function Insert_Data($bank_accounts_id,$account_number,$statues)
    {
		$shop_id=$_SESSION['getId_User'];
		$sql_Insert="INSERT INTO `bank_accounts_user` (`id`, `bank_accounts_id`, `shop_id`
		, `account_number`, `statues`)
        VALUES ('null','$bank_accounts_id', '$shop_id'
		, '$account_number', '$statues') ";

        if ($this->Database->Connect->query($sql_Insert) == true) {
                    echo '<script> 
                 Swal.fire({
      title: "تم الحفظ بنجاح!",
      text: "من فضلك قم بنقر على موافق",
      type: "success",
      confirmButtonClass: "btn btn-primary",
      buttonsStyling: false,
    });
	</script>';
	
        } else {
    echo '<script>
			Swal.fire({
      type: "error",
      title: "error...",
      text: "هناك خطأ ما!",
      confirmButtonClass: "btn btn-primary",
      buttonsStyling: true,
    })
	</script>';
        }
 }

    public function Update_Data($sql)
    {

        if ($this->Database->Connect->query($sql) == true) {
                   echo '<script> 
              Swal.fire({
      title: "تم التعديل بنجاح!",
      text: "من فضلك قم بنقر على موافق",
      type: "success",
      confirmButtonClass: "btn btn-primary",
      buttonsStyling: false,
    });
	</script>';           
		 } else {
             echo '<script>
			Swal.fire({
      type: "error",
      title: "error...",
      text: "هناك خطأ ما!",
      confirmButtonClass: "btn btn-primary",
      buttonsStyling: true,
    })
	</script>'
	;
        }
    }

    public function Read_Data()
    {
		$shop_id=$_SESSION['getId_User'];
        
		$sql="SELECT bank_user.id,bank_user.bank_accounts_id,bank_user.shop_id,bank_user.account_number,bank_user.statues
		,bank.imge,bank.account_name FROM bank_accounts_user bank_user,bank_accounts bank where bank_user.bank_accounts_id=bank.id and shop_id=".$shop_id;
                     
        $result = $this->Database->Connect->query($sql);
        if ($result->num_rows > 0) {

            $num = $result->num_rows;

            for ($i = 0; $i < $num; $i++) {
                # code...
                $data[$i] = mysqli_fetch_array($result);
            }

        }
        return $data;
    }
  
    public function Read_Data_bank_accounts()
    {
        
        $sql="SELECT *FROM bank_accounts";
                     
        $result = $this->Database->Connect->query($sql);
        if ($result->num_rows > 0) {

            $num = $result->num_rows;

            for ($i = 0; $i < $num; $i++) {
                # code...
                $data[$i] = mysqli_fetch_array($result);
            }

        }
        return $data;
    }
   

    public function Delete_Data($id)
    {

        $sql_DELETE = "DELETE FROM `bank_accounts_user` WHERE `id` = '$id'  ";

        if ($this->Database->Connect->query($sql_DELETE) == true) {
                              echo '<script> 
     Swal.fire({
        title: "تم الحذف بنجاح!",
        text: "من فضلك قم بنقر على موافق",
        type: "success",
        confirmButtonClass: "btn btn-primary",
        buttonsStyling: false,
    });
	</script>';  
        } else{
        $error = $this->Database->Connect->error;
        
        // استخراج اسم الجدول المرتبط
        $related_table = "غير معروف";
        if (preg_match('/`(\w+)`.*?FOREIGN KEY/', $error, $matches)) {
            $related_table = $matches[1];
        } elseif (preg_match('/REFERENCES `(\w+)`/', $error, $matches)) {
            $related_table = $matches[1];
        }
        
        // ترجمة اسم الجدول
        $table_translations = [
            'roqsa_frha_2026' => 'حسابات بنكية',
            'sections' => 'الأقسام',
            'orders' => 'الطلبات',
            'products' => 'المنتجات',
            'users' => 'المستخدمين',
            'employees' => 'الموظفين',
            'bank_accounts' => 'الحسابات البنكية'
        ];
        
        $table_ar = isset($table_translations[$related_table]) ? $table_translations[$related_table] : $related_table;
        
        // رسالة الخطأ المبسطة
        $error_message = "لا يمكن الحذف: هذا المتجر مرتبط بجدول <strong>$table_ar</strong>. قم بحذف البيانات المرتبطة أولاً.";
        
        echo '<script>
        Swal.fire({
            icon: "error",
            title: "خطأ في الحذف!",
            html: "' . addslashes($error_message) . '",
            confirmButtonClass: "btn btn-primary",
            buttonsStyling: true,
            confirmButtonText: "فهمت"
        });
        </script>';
    }

    }

}