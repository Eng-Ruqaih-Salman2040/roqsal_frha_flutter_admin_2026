<?php
class M_reservations
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

    public function Insert_Data($name, $statues)
    {
        $sql_Insert = "INSERT INTO `reservations` (`id`, `name`, `statues`) VALUES ('null','$name', '$statues')";
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
            </script>';
        }
    }

    // قراءة بيانات الحجوزات المنتظرة لمقدم الخدمة
    public function Read_Data_status0()
    {
        // التأكد من وجود الجلسة
        if (!isset($_SESSION['getId_User']) || empty($_SESSION['getId_User'])) {
            return array(); // إرجاع مصفوفة فارغة إذا لا يوجد معرف
        }
        
        $id = $_SESSION['getId_User'];
        
        // استعلام محدث مع التأكد من العلاقات الصحيحة
        $sql = "SELECT r.id, r.booking_date, r.reservation_status, r.note, r.bond_no, r.A_reservation_status,
                       c.name, c.email, c.phone, b.account_name, r.shop_id
                FROM reservations r
                LEFT JOIN customers c ON c.id = r.customers_id
                LEFT JOIN bank_accounts_user b_user ON b_user.id = r.bank_accounts_user_id
                LEFT JOIN bank_accounts b ON b.id = b_user.bank_accounts_id
                WHERE r.reservation_status = 0 
                AND r.A_reservation_status = 1
                AND r.shop_id = '$id'
                ORDER BY r.booking_date DESC";
        
        // للتأكد من الاستعلام (يمكنك إزالته بعد التأكد)
        error_log("استعلام مقدم الخدمة: " . $sql);
        
        $result = $this->Database->Connect->query($sql);
        $data = array();
        
        if ($result) {
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
            } else {
                // لا توجد نتائج - هذا طبيعي إذا مافي حجوزات
                error_log("لا توجد حجوزات لمقدم الخدمة رقم: " . $id);
            }
        } else {
            // خطأ في الاستعلام
            error_log("خطأ في استعلام مقدم الخدمة: " . $this->Database->Connect->error);
        }
        
        return $data;
    }

    // قراءة جميع الحجوزات المنتظرة للأدمن
    public function Read_Data_Admin()
    {
        $sql = "SELECT r.id, r.booking_date, r.reservation_status, r.note, r.bond_no, 
                       r.A_reservation_status, c.name, c.email, c.phone, b.account_name,
                       sh.name as shop_name, sh.price, r.shop_id
                FROM reservations r
                LEFT JOIN customers c ON c.id = r.customers_id
                LEFT JOIN bank_accounts_user b_user ON b_user.id = r.bank_accounts_user_id
                LEFT JOIN bank_accounts b ON b.id = b_user.bank_accounts_id
                LEFT JOIN shop sh ON sh.id = r.shop_id
                WHERE r.reservation_status = 0 
                AND r.A_reservation_status = 0
                ORDER BY r.booking_date DESC";
        
        // للتأكد من الاستعلام
        error_log("استعلام الأدمن: " . $sql);
        
        $result = $this->Database->Connect->query($sql);
        $data = array();
        
        if ($result) {
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                }
            }
        }
        
        return $data;
    }

    // قراءة الحجوزات المؤكدة من مقدم الخدمة
    public function Read_Data_status1()
    {
        if (!isset($_SESSION['getId_User']) || empty($_SESSION['getId_User'])) {
            return array();
        }
        
        $id = $_SESSION['getId_User'];
        
        $sql = "SELECT r.id, r.booking_date, r.reservation_status, r.note, r.bond_no, 
                       c.name, c.email, c.phone, b.account_name 
                FROM reservations r
                LEFT JOIN customers c ON c.id = r.customers_id
                LEFT JOIN bank_accounts_user b_user ON b_user.id = r.bank_accounts_user_id
                LEFT JOIN bank_accounts b ON b.id = b_user.bank_accounts_id
                WHERE r.reservation_status = 1 
                AND r.shop_id = '$id'
                ORDER BY r.booking_date DESC";
        
        $result = $this->Database->Connect->query($sql);
        $data = array();
        
        if ($result && $result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    // قراءة الحجوزات المرفوضة من مقدم الخدمة
    public function Read_Data_status2()
    {
        if (!isset($_SESSION['getId_User']) || empty($_SESSION['getId_User'])) {
            return array();
        }
        
        $id = $_SESSION['getId_User'];
        
        $sql = "SELECT r.id, r.booking_date, r.reservation_status, r.note, r.bond_no, 
                       c.name, c.email, c.phone, b.account_name 
                FROM reservations r
                LEFT JOIN customers c ON c.id = r.customers_id
                LEFT JOIN bank_accounts_user b_user ON b_user.id = r.bank_accounts_user_id
                LEFT JOIN bank_accounts b ON b.id = b_user.bank_accounts_id
                WHERE r.reservation_status = 2 
                AND r.shop_id = '$id'
                ORDER BY r.booking_date DESC";
        
        $result = $this->Database->Connect->query($sql);
        $data = array();
        
        if ($result && $result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }

    // قراءة جميع الحجوزات مع تفاصيل المتجر
    public function Read_Data_status3()
    {
        $sql = "SELECT r.id, r.booking_date, r.reservation_status, r.note, r.bond_no,
                       r.A_reservation_status, c.name, c.email, c.phone,
                       sh.name as 'shop_name', sh.price, sh.phone as 'shop_phone',
                       b.account_name 
                FROM reservations r
                LEFT JOIN customers c ON c.id = r.customers_id
                LEFT JOIN shop sh ON sh.id = r.shop_id
                LEFT JOIN bank_accounts_user b_user ON b_user.id = r.bank_accounts_user_id
                LEFT JOIN bank_accounts b ON b.id = b_user.bank_accounts_id
                ORDER BY r.booking_date DESC";
        
        $result = $this->Database->Connect->query($sql);
        $data = array();
        
        if ($result && $result->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
        }
        return $data;
    }
    
    // دالة مساعدة للتأكد من وجود حجوزات لمقدم الخدمة
    // public function CheckProviderBookings($provider_id)
    // {
    //     $sql = "SELECT COUNT(*) as total FROM reservations WHERE shop_id = '$provider_id' AND reservation_status = 0 AND A_reservation_status = 0";
    //     $result = $this->Database->Connect->query($sql);
    //     if ($result) {
    //         $row = mysqli_fetch_assoc($result);
    //         return $row['total'];
    //     }
    //     return 0;
    // }
}
?>