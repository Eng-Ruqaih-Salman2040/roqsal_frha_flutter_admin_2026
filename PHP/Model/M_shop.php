<?php


class M_shop
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
            include '../Model/Database.php';
            $vars = '../include/vars.php';
            $this->Database = new Database($vars);
        } catch (\Throwable $th) {
            throw new Exception("Error ", 1);
        }
    }

    public function Insert_Data($user_name, $password, $city_id, $name, $phone, $email, $image, $profession_license, $price, $description, $statues, $address, $section_id, $rating_Admin = 0,$cut,$latlng)
    {
        // جلب رقم الأدمن من الجلسة
        $A_id = isset($_SESSION['getId_User']) ? $_SESSION['getId_User'] : 0;
        
        // استعلام INSERT مع A_id
        $sql_Insert = "INSERT INTO `shop` (`user_name`, `password`, `city_id`, `name`, `phone`, `email`, `image`, `profession_license`, `price`, `description`, `statues`, `address`, `section_id`, `rating_Admin`, `A_id`,`cut`,`latlng`) 
                        VALUES ('$user_name', '$password', '$city_id', '$name', '$phone', '$email', '$image', '$profession_license', '$price', '$description', '$statues', '$address', '$section_id', '$rating_Admin', '$A_id','$cut','$latlng')";

        if ($this->Database->Connect->query($sql_Insert) == true) {
            echo '<script> 
                Swal.fire({
                    title: "تم الحفظ بنجاح!",
                    text: "تمت إضافة المتجر بواسطة: ' . $_SESSION['UserName'] . '",
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
                    title: "خطأ في التعديل",
                    text: "' . $this->Database->Connect->error . '",
                    confirmButtonClass: "btn btn-primary",
                    buttonsStyling: true,
                });
            </script>';
        }
    }

    public function Read_Data()
    {
        $sql = "SELECT section.name as 'section_name', shop.* FROM shop, section WHERE shop.section_id = section.id";
        $result = $this->Database->Connect->query($sql);
        $data = array();
        
        if ($result->num_rows > 0) {
            $num = $result->num_rows;
            for ($i = 0; $i < $num; $i++) {
                $data[$i] = mysqli_fetch_array($result);
            }
        }
        return $data;
    }
  
    public function Read_Data_city()
    {
        $sql = "SELECT * FROM city";
        $result = $this->Database->Connect->query($sql);
        $data = array();
        
        if ($result->num_rows > 0) {
            $num = $result->num_rows;
            for ($i = 0; $i < $num; $i++) {
                $data[$i] = mysqli_fetch_array($result);
            }
        }
        return $data;
    }
   
    public function Read_Data_section()
    {
        $sql = "SELECT * FROM section";
        $result = $this->Database->Connect->query($sql);
        $data = array();
        
        if ($result->num_rows > 0) {
            $num = $result->num_rows;
            for ($i = 0; $i < $num; $i++) {
                $data[$i] = mysqli_fetch_array($result);
            }
        }
        return $data;
    }
    
    public function Delete_Data($id)
    {
        $id = $this->Database->Connect->real_escape_string($id);
        
        $sql_DELETE = "DELETE FROM `shop` WHERE `id` = '$id'";
        
        if ($this->Database->Connect->query($sql_DELETE)) {
            echo '<script> 
                Swal.fire({
                    title: "تم الحذف بنجاح!",
                    text: "من فضلك قم بنقر على موافق",
                    icon: "success",
                    confirmButtonClass: "btn btn-primary",
                    buttonsStyling: false,
                });
            </script>';  
        } else {
            $error = $this->Database->Connect->error;
            
            $related_table = "غير معروف";
            if (preg_match('/`(\w+)`.*?FOREIGN KEY/', $error, $matches)) {
                $related_table = $matches[1];
            } elseif (preg_match('/REFERENCES `(\w+)`/', $error, $matches)) {
                $related_table = $matches[1];
            }
            
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
?>