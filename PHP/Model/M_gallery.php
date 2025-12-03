<?php

class M_gallery
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

    public function Insert_Data($insertValuesSQL)
    {
        $sql_Insert="INSERT INTO gallery (shop_id,file_name, uploaded_on) VALUES $insertValuesSQL";
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
        $id=$_SESSION['getId_User'];
        $sql="SELECT *FROM gallery WHERE shop_id=$id";
                     
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

        $sql_DELETE = "DELETE FROM `gallery` WHERE `id` = '$id'  ";

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