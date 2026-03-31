<?php

class M_notifications
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

    public function Insert_Data($note, $date_create, $time_create)
{
    // التحقق من وجود أدمن مسجل دخول
    if (isset($_SESSION['getId_User']) && !empty($_SESSION['getId_User'])) {
        
        // رقم الأدمن من الجلسة
        $A_id = $_SESSION['getId_User'];
        
        // استعلام INSERT مع إضافة A_id
        $sql_Insert = "INSERT INTO `notifications` (`note`, `date_create`, `time_create`, `A_id`) 
                        VALUES ('$note', '$date_create', '$time_create', '$A_id')";
        
        if ($this->Database->Connect->query($sql_Insert) == true) {
            echo '<script> 
                Swal.fire({
                    title: "تم الحفظ بنجاح!",
                    text: "تمت إضافة الإشعار بواسطة: ' . $_SESSION['UserName'] . '",
                    type: "success",
                    confirmButtonClass: "btn btn-primary",
                    buttonsStyling: false,
                });
            </script>';
        } else {
            echo '<script>
                Swal.fire({
                    type: "error",
                    title: "خطأ في الإضافة",
                    text: "' . $this->Database->Connect->error . '",
                    confirmButtonClass: "btn btn-primary",
                    buttonsStyling: true,
                });
            </script>';
        }
        
    } else {
        echo '<script>
            Swal.fire({
                type: "error",
                title: "غير مسموح",
                text: "الرجاء تسجيل الدخول أولاً",
                confirmButtonClass: "btn btn-primary",
                buttonsStyling: true,
            });
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
        
        $sql="SELECT *FROM notifications";
                     
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

        $sql_DELETE = "DELETE FROM `notifications` WHERE `id` = '$id'  ";

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

}