<?php
include 'include/vars.php';
$opration = new Opration();
define('conString', 'mysql:host=' . $host . ';dbname=' . $database . ';charset=utf8');
define('dbUser', $userName);
define('dbPass', $password);

$opration->dbConnect(conString, dbUser, dbPass);

// التعامل مع طلبات GET و POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // للطلبات POST (FormData)
    $checkwhat = $_POST["checkopration"] ?? $_REQUEST["checkopration"];
} else {
    // للطلبات GET
    $checkwhat = $_GET["checkopration"] ?? $_REQUEST["checkopration"];
}

switch ($checkwhat) {

    case 'Login':
        $name = $_REQUEST["name"] ?? $_POST["name"] ?? $_GET["name"];
        $password = $_REQUEST["password"] ?? $_POST["password"] ?? $_GET["password"];
        $opration->Login($name, $password);
        break;

    case 'load_Data_section':
        $opration->load_Data_section();
        break;
        
    case 'load_Data_Ads':
        $opration->load_Data_Ads();
        break;
        
    case 'load_Data_Notifications':
        $opration->load_Data_Notifications();
        break;

    case 'load_Data_reservations':
        $id = $_REQUEST['id'] ?? $_POST['id'] ?? $_GET['id'];
        $reservation_status = $_REQUEST['reservation_status'] ?? $_POST['reservation_status'] ?? $_GET['reservation_status'];
        $opration->load_Data_reservations($id, $reservation_status);
        break;

    case 'load_Data_Bank_accounts':
        $opration->load_Data_Bank_accounts();
        break;

    case 'Reserve_shop':
        $customers_id = $_REQUEST['customers_id'] ?? $_POST['customers_id'] ?? $_GET['customers_id'];
        $bank_id = $_REQUEST['bank_id'] ?? $_POST['bank_id'] ?? $_GET['bank_id'];
        $bond_no = $_REQUEST['bond_no'] ?? $_POST['bond_no'] ?? $_GET['bond_no'];
        $shop_id = $_REQUEST['shop_id'] ?? $_POST['shop_id'] ?? $_GET['shop_id'];
        $note = $_REQUEST['note'] ?? $_POST['note'] ?? $_GET['note'];
        $booking_date = $_REQUEST['booking_date'] ?? $_POST['booking_date'] ?? $_GET['booking_date'];
        $opration->Reserve_shop($customers_id, $bank_id, $bond_no, $shop_id, $note, $booking_date);
        break;

    case 'load_Data_shop_favorite':
        $customers_id = $_REQUEST['customers_id'] ?? $_POST['customers_id'] ?? $_GET['customers_id'];
        $opration->load_Data_shop_favorite($customers_id);
        break;

    case 'add_favorite':
        $customers_id = $_REQUEST['customers_id'] ?? $_POST['customers_id'] ?? $_GET['customers_id'];
        $shop_id = $_REQUEST['shop_id'] ?? $_POST['shop_id'] ?? $_GET['shop_id'];
        $opration->add_favorite($customers_id, $shop_id);
        break;

    case 'delete_favorite':
        $customers_id = $_REQUEST['customers_id'] ?? $_POST['customers_id'] ?? $_GET['customers_id'];
        $shop_id = $_REQUEST['shop_id'] ?? $_POST['shop_id'] ?? $_GET['shop_id'];
        $opration->delete_favorite($customers_id, $shop_id);
        break;

    case 'load_Data_shop':
        $section_id = $_REQUEST['section_id'] ?? $_POST['section_id'] ?? $_GET['section_id'];
        $opration->load_Data_shop($section_id);
        break;

    case 'PaymentMethod':
        $shop_id = $_REQUEST['shop_id'] ?? $_POST['shop_id'] ?? $_GET['shop_id'];
        $opration->PaymentMethod($shop_id);
        break;
        
    case 'gallery':
        $shop_id = $_REQUEST['shop_id'] ?? $_POST['shop_id'] ?? $_GET['shop_id'];
        $opration->gallery($shop_id);
        break;

    case 'Technical_Support':
        $name = $_REQUEST['name'] ?? $_POST['name'] ?? $_GET['name'];
        $email = $_REQUEST['email'] ?? $_POST['email'] ?? $_GET['email'];
        $subject = $_REQUEST['subject'] ?? $_POST['subject'] ?? $_GET['subject'];
        $message = $_REQUEST['message'] ?? $_POST['message'] ?? $_GET['message'];
        $opration->Technical_Support($name, $email, $subject, $message);
        break;
        
    case 'view':
        $shop_id = $_REQUEST['shop_id'] ?? $_POST['shop_id'] ?? $_GET['shop_id'];
        $opration->view($shop_id);
        break;

    case 'Sign_Up':
        $name = $_REQUEST['name'] ?? $_POST['name'] ?? $_GET['name'];
        $pass = $_REQUEST['pass'] ?? $_POST['pass'] ?? $_GET['pass'];
        $phone = $_REQUEST['phone'] ?? $_POST['phone'] ?? $_GET['phone'];
        $email = $_REQUEST['email'] ?? $_POST['email'] ?? $_GET['email'];
        $opration->Sign_Up($name, $pass, $phone, $email);
        break;

     case 'get_ratings':
        $shop_id = $_REQUEST['shop_id'] ?? $_POST['shop_id'] ?? $_GET['shop_id'];
         $opration->get_ratings($shop_id);
         break;
    
    case 'add_rating':
         $customer_id = $_REQUEST['customer_id'] ?? $_POST['customer_id'] ?? $_GET['customer_id'];
         $shop_id = $_REQUEST['shop_id'] ?? $_POST['shop_id'] ?? $_GET['shop_id'];
         $rating_value = $_REQUEST['rating_value'] ?? $_POST['rating_value'] ?? $_GET['rating_value'] ;
         $review_comment = $_REQUEST['review_comment'] ?? $_POST['review_comment'] ?? $_GET['review_comment'] ;
         $opration->add_rating($customer_id, $shop_id,$rating_value,$review_comment);
         break;

    default:
        $output = array();
        $output['success'] = false;
        $output['message'] = "Invalid operation";
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
}

class Opration {
    private $pdo;

    public function dbConnect($conString, $user, $pass) {
        try {
            $pdo = new PDO($conString, $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec("set names utf8");
            $this->pdo = $pdo;
            return true;
        } catch (PDOException $e) {
            $this->msg = 'Connection did not work out!';
            return false;
        }
    }

    public function load_Data_Ads() {
        $output['ads'] = array();
        $result = $this->pdo->prepare("SELECT * FROM ads ORDER BY `id` DESC");
        if ($result->execute()) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $index['id'] = $row['id'];
                $index['imge'] = $row['imge'];
                $index['note'] = $row['note'];
                $index['date_create'] = $row['date_create'];
                $index['time_create'] = $row['time_create'];
                array_push($output['ads'], $index);
            }
            $output['success'] = true;
            $output['message'] = "success";
        } else {
            $error = $result->errorInfo();
            $output['success'] = false;
            $output['message'] = "error" . $error[2];
        }
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }

    public function load_Data_Notifications() {
        $output['notifications'] = array();
        $result = $this->pdo->prepare("SELECT * FROM notifications ORDER BY `id` DESC");
        if ($result->execute()) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $index['id'] = $row['id'];
                $index['note'] = $row['note'];
                $index['date_create'] = $row['date_create'];
                $index['time_create'] = $row['time_create'];
                array_push($output['notifications'], $index);
            }
            $output['success'] = true;
            $output['message'] = "success";
        } else {
            $error = $result->errorInfo();
            $output['success'] = false;
            $output['message'] = "error" . $error[2];
        }
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }

    public function load_Data_reservations($id, $reservation_status) {
        $output['reservations'] = array();
        $sql = "SELECT section.name as 'section_name', reservations.id, reservations.booking_date, 
                reservations.reservation_status, reservations.note, reservations.bond_no,
                customers.email, customers.phone, bank_accounts.account_name, 
                shop.name, shop.image, shop.price
                FROM reservations 
                INNER JOIN shop ON shop.id = reservations.shop_id 
                INNER JOIN customers ON customers.id = reservations.customers_id 
                INNER JOIN bank_accounts_user ON bank_accounts_user.id = reservations.bank_accounts_user_id
                INNER JOIN bank_accounts ON bank_accounts_user.bank_accounts_id = bank_accounts.id
                INNER JOIN section ON shop.section_id = section.id
                WHERE reservations.reservation_status = :reservation_status 
                AND customers.id = :id";
        
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':id', $id);
        $result->bindParam(':reservation_status', $reservation_status);
        
        if ($result->execute()) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $index['id'] = $row['id'];
                $index['booking_date'] = $row['booking_date'];
                $index['reservation_status'] = $row['reservation_status'];
                $index['note'] = $row['note'];
                $index['bond_no'] = $row['bond_no'];
                $index['name'] = $row['name'];
                $index['price'] = $row['price'];
                $index['section_name'] = $row['section_name'];
                $index['image'] = $row['image'];
                $index['email'] = $row['email'];
                $index['phone'] = $row['phone'];
                $index['account_name'] = $row['account_name'];
                array_push($output['reservations'], $index);
            }
            $output['success'] = true;
            $output['message'] = "success";
        } else {
            $error = $result->errorInfo();
            $output['success'] = false;
            $output['message'] = "error" . $error[2];
        }
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }

    public function load_Data_shop($section_id) {
        $output['shop'] = array();
        $sql = "SELECT shop.*, city.name as 'city_name', section.name as 'section_name' 
                FROM shop
                INNER JOIN city ON city.id = shop.city_id 
                INNER JOIN section ON section.id = shop.section_id 
                WHERE shop.statues = 1 AND shop.section_id = :section_id";
        
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':section_id', $section_id);
        
        if ($result->execute()) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $index['id'] = $row['id'];
                $index['user_name'] = $row['user_name'];
                $index['passowrd'] = $row['password'];
                $index['name_shop'] = $row['name'];
                $index['city_name'] = $row['city_name'];
                $index['section_name'] = $row['section_name'];
                $index['adress'] = $row['address'];
                $index['email'] = $row['email'];
                $index['phone'] = $row['phone'];
                $index['image'] = $row['image'];
                $index['description'] = $row['description'];
                $index['price'] = $row['price'];
                $index['viewer'] = $row['viewer'];
                array_push($output['shop'], $index);
            }
            $output['success'] = true;
            $output['message'] = "success";
        } else {
            $error = $result->errorInfo();
            $output['success'] = false;
            $output['message'] = "error" . $error[2];
        }
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }

    public function load_Data_section() {
        $output['section'] = array();
        $sql = "SELECT section.*, 
                (SELECT COUNT(*) FROM shop WHERE shop.statues = 1 AND shop.section_id = section.id) AS count_shop 
                FROM section 
                WHERE status = 1 
                ORDER BY sort, name ASC";
        
        $result = $this->pdo->prepare($sql);
        if ($result->execute()) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $index['id'] = $row['id'];
                $index['name'] = $row['name'];
                $index['image'] = $row['image'];
                $index['count_shop'] = $row['count_shop'];
                array_push($output['section'], $index);
            }
            $output['success'] = true;
            $output['message'] = "success";
        } else {
            $error = $result->errorInfo();
            $output['success'] = false;
            $output['message'] = "error" . $error[2];
        }
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }

    public function PaymentMethod($shop_id) {
        $output['PaymentMethod'] = array();
        $sql = "SELECT bank_user.id, bank_user.bank_accounts_id, bank_user.shop_id, 
                bank_user.account_number, bank_user.statues, bank.imge, bank.account_name 
                FROM bank_accounts_user bank_user
                INNER JOIN bank_accounts bank ON bank_user.bank_accounts_id = bank.id 
                WHERE bank_user.statues = '1' AND bank_user.shop_id = :shop_id";
        
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':shop_id', $shop_id);
        
        if ($result->execute()) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $index['id'] = $row['id'];
                $index['imge'] = $row['imge'];
                $index['account_name'] = $row['account_name'];
                $index['account_number'] = $row['account_number'];
                array_push($output['PaymentMethod'], $index);
            }
            $output['success'] = true;
            $output['message'] = "success";
        } else {
            $error = $result->errorInfo();
            $output['success'] = false;
            $output['message'] = "error" . $error[2];
        }
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }

    public function gallery($shop_id) {
        $output['gallery'] = array();
        
        // جلب معرض الصور
        $sql = "SELECT * FROM gallery WHERE status = '1' AND shop_id = :shop_id";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':shop_id', $shop_id);
        
        if ($result->execute()) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $index['id'] = $row['id'];
                $index['imge'] = $row['file_name'];
                array_push($output['gallery'], $index);
            }
            $output['success'] = true;
            $output['message'] = "success";
            
            // تحديث عدد المشاهدات
            $updateSql = "UPDATE shop SET viewer = viewer + 1 WHERE id = :shop_id";
            $updateStmt = $this->pdo->prepare($updateSql);
            $updateStmt->bindParam(':shop_id', $shop_id);
            $updateStmt->execute();
            
        } else {
            $error = $result->errorInfo();
            $output['success'] = false;
            $output['message'] = "error" . $error[2];
        }
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }

    public function Reserve_shop($customers_id, $bank_id, $bond_no, $shop_id, $note, $booking_date) {
        $output = array();
        
        // التحقق من عدم وجود حجز مسبق
        $checkSql = "SELECT * FROM reservations WHERE shop_id = :shop_id AND booking_date = :booking_date";
        $checkStmt = $this->pdo->prepare($checkSql);
        $checkStmt->bindParam(':shop_id', $shop_id);
        $checkStmt->bindParam(':booking_date', $booking_date);
        $checkStmt->execute();
        
        if ($checkStmt->rowCount() > 0) {
            $output['success'] = true;
            $output['message'] = "هذا التاريخ محجوز مسبقاً";
            $output['reservation_check'] = false;
        } else {
            // إضافة الحجز
            $insertSql = "INSERT INTO reservations (bank_accounts_user_id, shop_id, customers_id, booking_date, reservation_status, note, bond_no)
                          VALUES (:bank_id, :shop_id, :customers_id, :booking_date, '0', :note, :bond_no)";
            
            $insertStmt = $this->pdo->prepare($insertSql);
            $insertStmt->bindParam(':bank_id', $bank_id);
            $insertStmt->bindParam(':shop_id', $shop_id);
            $insertStmt->bindParam(':customers_id', $customers_id);
            $insertStmt->bindParam(':booking_date', $booking_date);
            $insertStmt->bindParam(':note', $note);
            $insertStmt->bindParam(':bond_no', $bond_no);
            
            if ($insertStmt->execute()) {
                $output['success'] = true;
                $output['message'] = "تم ارسال طلب الحجز بنجاح";
                $output['reservation_check'] = true;
                $output['reservation_id'] = $this->pdo->lastInsertId();
            } else {
                $error = $insertStmt->errorInfo();
                $output['success'] = false;
                $output['message'] = "خطأ في الحجز: " . $error[2];
                $output['reservation_check'] = true;
            }
        }
        
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }

    public function load_Data_shop_favorite($customers_id) {
        $output['data'] = array(); // استخدام data كما هو مطلوب في Flutter
        
        // تعديل الاستعلام: إزالة created_at إذا لم يكن موجوداً
        $sql = "SELECT 
                    f.id as favorite_id,
                    f.shop_id,
                    f.customers_id,
                    s.name as shop_name,
                    s.image as shop_image,
                    s.description as shop_description,
                    s.address as shop_address,
                    s.phone as shop_phone,
                    s.email as shop_email,
                    s.price,
                    s.viewer,
                    c.name as city_name,
                    sec.name as section_name
                FROM favorite f
                INNER JOIN shop s ON f.shop_id = s.id
                LEFT JOIN city c ON s.city_id = c.id
                LEFT JOIN section sec ON s.section_id = sec.id
                WHERE f.customers_id = :customers_id
                ORDER BY f.id DESC";
        
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':customers_id', $customers_id);
        
        if ($result->execute()) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $index = array();
                $index['favorite_id'] = $row['favorite_id'];
                $index['shop_id'] = $row['shop_id'];
                $index['customers_id'] = $row['customers_id'];
                $index['favorite_date'] = date('Y-m-d H:i:s'); // تاريخ افتراضي
                $index['shop_name'] = $row['shop_name'];
                $index['shop_image'] = $row['shop_image'];
                $index['shop_description'] = $row['shop_description'];
                $index['shop_address'] = $row['shop_address'];
                $index['shop_phone'] = $row['shop_phone'];
                $index['shop_email'] = $row['shop_email'];
                $index['price'] = $row['price'];
                $index['viewer'] = $row['viewer'];
                $index['city_name'] = $row['city_name'];
                $index['section_name'] = $row['section_name'];
                
                array_push($output['data'], $index);
            }
            
            $output['success'] = true;
            $output['message'] = "تم تحميل المفضلة بنجاح";
            $output['status'] = "success";
            $output['total_count'] = count($output['data']);
            $output['customers_id'] = $customers_id;
            
        } else {
            $error = $result->errorInfo();
            $output['success'] = false;
            $output['message'] = "خطأ في تحميل المفضلة: " . $error[2];
            $output['status'] = "error";
            $output['data'] = array();
            $output['total_count'] = 0;
        }
        
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }

    public function add_favorite($customers_id, $shop_id) {
        $output = array();
        
        // التحقق من وجود الجدول ومعرفة هيكله
        try {
            // التحقق من عدم وجود تكرار
            $checkSql = "SELECT id FROM favorite WHERE customers_id = :customers_id AND shop_id = :shop_id";
            $checkStmt = $this->pdo->prepare($checkSql);
            $checkStmt->bindParam(':customers_id', $customers_id);
            $checkStmt->bindParam(':shop_id', $shop_id);
            $checkStmt->execute();
            
            if ($checkStmt->rowCount() == 0) {
                $insertSql = "INSERT INTO favorite (shop_id, customers_id) VALUES (:shop_id, :customers_id)";
                
                $insertStmt = $this->pdo->prepare($insertSql);
                $insertStmt->bindParam(':shop_id', $shop_id);
                $insertStmt->bindParam(':customers_id', $customers_id);
                
                if ($insertStmt->execute()) {
                    $output['success'] = true;
                    $output['message'] = "تمت الإضافة إلى المفضلة بنجاح";
                    $output['favorite_id'] = $this->pdo->lastInsertId();
                } else {
                    $error = $insertStmt->errorInfo();
                    $output['success'] = false;
                    $output['message'] = "خطأ في الإضافة: " . $error[2];
                }
            } else {
                $output['success'] = false;
                $output['message'] = "المتجر موجود بالفعل في المفضلة";
            }
        } catch (PDOException $e) {
            $output['success'] = false;
            $output['message'] = "خطأ في قاعدة البيانات: " . $e->getMessage();
        }
        
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }

    public function delete_favorite($customers_id, $shop_id) {
        $output = array();
        
        // حذف من المفضلة
        $deleteSql = "DELETE FROM favorite WHERE customers_id = :customers_id AND shop_id = :shop_id";
        $deleteStmt = $this->pdo->prepare($deleteSql);
        $deleteStmt->bindParam(':customers_id', $customers_id);
        $deleteStmt->bindParam(':shop_id', $shop_id);
        
        if ($deleteStmt->execute()) {
            if ($deleteStmt->rowCount() > 0) {
                $output['success'] = true;
                $output['message'] = "تم الحذف من المفضلة بنجاح";
            } else {
                $output['success'] = false;
                $output['message'] = "المتجر غير موجود في المفضلة";
            }
        } else {
            $error = $deleteStmt->errorInfo();
            $output['success'] = false;
            $output['message'] = "خطأ في الحذف: " . $error[2];
        }
        
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }

    public function Login($name, $password) {
        $output = array();
        
        $sql = "SELECT * FROM customers WHERE name = :name AND password = :password";
        $result = $this->pdo->prepare($sql);
        $result->bindParam(':name', $name);
        $result->bindParam(':password', $password);
        
        if ($result->execute()) {
            if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $output['id'] = $row['id'];
                $output['imge'] = $row['imge'];
                $output['name'] = $row['name'];
                $output['password'] = $row['password'];
                $output['phone'] = $row['phone'];
                $output['email'] = $row['email'];
                $output['date_register'] = $row['date_register'];
                $output['success'] = true;
                $output['message'] = "تم تسجيل الدخول بنجاح";
            } else {
                $output['success'] = false;
                $output['message'] = "اسم المستخدم أو كلمة المرور غير صحيحة";
            }
        } else {
            $error = $result->errorInfo();
            $output['success'] = false;
            $output['message'] = "خطأ في قاعدة البيانات: " . $error[2];
        }
        
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }

    public function Technical_Support($name, $email, $subject, $message) {
        $output = array();
        $date_create = date('Y-m-d');
        $time_create = date('H:i:s');
        
        $sql = "INSERT INTO Technical_Support (name, email, subject, message, status, date_create, time_create)
                VALUES (:name, :email, :subject, :message, '0', :date_create, :time_create)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);
        $stmt->bindParam(':date_create', $date_create);
        $stmt->bindParam(':time_create', $time_create);
        
        if ($stmt->execute()) {
            $output['success'] = true;
            $output['message'] = "تم إرسال الرسالة بنجاح";
        } else {
            $error = $stmt->errorInfo();
            $output['success'] = false;
            $output['message'] = "خطأ في الإرسال: " . $error[2];
        }
        
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }

    public function Sign_Up($name, $pass, $phone, $email) {
        $output = array();
        $date_register = date('Y-m-d');
        
        // التحقق من عدم وجود رقم هاتف مكرر
        $checkSql = "SELECT id FROM customers WHERE phone = :phone";
        $checkStmt = $this->pdo->prepare($checkSql);
        $checkStmt->bindParam(':phone', $phone);
        $checkStmt->execute();
        
        if ($checkStmt->rowCount() > 0) {
            $output['success'] = false;
            $output['message'] = "رقم الهاتف موجود مسبقاً";
            echo json_encode($output, JSON_UNESCAPED_UNICODE);
            return;
        }
        
        // إضافة المستخدم الجديد
        $insertSql = "INSERT INTO customers (imge, name, password, phone, email, date_register)
                      VALUES ('256292.png', :name, :pass, :phone, :email, :date_register)";
        
        $insertStmt = $this->pdo->prepare($insertSql);
        $insertStmt->bindParam(':name', $name);
        $insertStmt->bindParam(':pass', $pass);
        $insertStmt->bindParam(':phone', $phone);
        $insertStmt->bindParam(':email', $email);
        $insertStmt->bindParam(':date_register', $date_register);
        
        if ($insertStmt->execute()) {
            $customers_id = $this->pdo->lastInsertId();
            
            // جلب بيانات المستخدم الجديد
            $selectSql = "SELECT * FROM customers WHERE id = :id";
            $selectStmt = $this->pdo->prepare($selectSql);
            $selectStmt->bindParam(':id', $customers_id);
            $selectStmt->execute();
            
            if ($row = $selectStmt->fetch(PDO::FETCH_ASSOC)) {
                $output['customers_id'] = $row['id'];
                $output['imge'] = $row['imge'];
                $output['name'] = $row['name'];
                $output['password'] = $row['password'];
                $output['phone'] = $row['phone'];
                $output['email'] = $row['email'];
                $output['date_register'] = $row['date_register'];
                $output['success'] = true;
                $output['message'] = "تم إنشاء الحساب بنجاح";
            }
        } else {
            $error = $insertStmt->errorInfo();
            $output['success'] = false;
            $output['message'] = "خطأ في إنشاء الحساب: " . $error[2];
        }
        
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
    }

public function get_ratings($shop_id) {
    $output = array();
    
    // تنظيف أي مخرجات سابقة
    if (ob_get_length()) ob_clean();
    
    $page = isset($_REQUEST['page']) ? intval($_REQUEST['page']) : 1;
    $limit = 10;
    $offset = ($page - 1) * $limit;
    
    if (empty($shop_id)) {
        $output['success'] = false;
        $output['message'] = "معرف المتجر مطلوب";
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    try {
        // جلب ملخص التقييمات
        $summarySql = "SELECT 
                        COUNT(*) as total_reviews,
                        COALESCE(AVG(rating_value), 0) as average_rating,
                        SUM(CASE WHEN rating_value >= 4.5 THEN 1 ELSE 0 END) as five_star,
                        SUM(CASE WHEN rating_value >= 3.5 AND rating_value < 4.5 THEN 1 ELSE 0 END) as four_star,
                        SUM(CASE WHEN rating_value >= 2.5 AND rating_value < 3.5 THEN 1 ELSE 0 END) as three_star,
                        SUM(CASE WHEN rating_value >= 1.5 AND rating_value < 2.5 THEN 1 ELSE 0 END) as two_star,
                        SUM(CASE WHEN rating_value < 1.5 THEN 1 ELSE 0 END) as one_star
                      FROM ratings 
                      WHERE shop_id = ?";  
        
        $summaryStmt = $this->pdo->prepare($summarySql);
        $summaryStmt->execute([$shop_id]);
        $summary = $summaryStmt->fetch(PDO::FETCH_ASSOC);
        
        // جلب التقييمات مع تفاصيل العملاء - باستخدام bindParam
        $sql = "SELECT 
                    r.id_rating as id,
                    r.rating_value,
                    r.review_comment,
                    r.created_time as created_at,
                    c.id as customer_id,
                    c.name as customer_name,
                    c.imge as customer_image
                FROM ratings r
                INNER JOIN customers c ON r.customer_id = c.id
                WHERE r.shop_id = :shop_id
                ORDER BY r.created_time DESC
                LIMIT :limit OFFSET :offset";
        
        $stmt = $this->pdo->prepare($sql);
        
        // ربط المتغيرات مع تحديد النوع
        $stmt->bindParam(':shop_id', $shop_id, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        
        $stmt->execute();
        
        $reviews = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $review = array(
                'id' => intval($row['id']),
                'customer_id' => intval($row['customer_id']),
                'customer_name' => $row['customer_name'],
                'customer_image' => $row['customer_image'] ?? '',
                'rating_value' => floatval($row['rating_value']),
                'review_comment' => $row['review_comment'] ?? '',
                'created_at' => $row['created_at'],
            );
            $reviews[] = $review;
        }
        
        // حساب إجمالي الصفحات
        $totalStmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM ratings WHERE shop_id = ?");
        $totalStmt->execute([$shop_id]);
        $total = $totalStmt->fetch(PDO::FETCH_ASSOC);
        $totalPages = $total['total'] > 0 ? ceil($total['total'] / $limit) : 1;
        
        $output['success'] = true;
        $output['message'] = "تم جلب التقييمات بنجاح";
        $output['reviews'] = $reviews;
        $output['summary'] = array(
            'total_reviews' => intval($summary['total_reviews'] ?? 0),
            'average_rating' => floatval($summary['average_rating'] ?? 0),
            'five_star' => intval($summary['five_star'] ?? 0),
            'four_star' => intval($summary['four_star'] ?? 0),
            'three_star' => intval($summary['three_star'] ?? 0),
            'two_star' => intval($summary['two_star'] ?? 0),
            'one_star' => intval($summary['one_star'] ?? 0)
        );
        $output['pagination'] = array(
            'current_page' => $page,
            'total_pages' => $totalPages,
            'total_items' => intval($total['total']),
            'per_page' => $limit
        );
        
    } catch (PDOException $e) {
        $output['success'] = false;
        $output['message'] = "خطأ في جلب التقييمات: " . $e->getMessage();
    }
    
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

   public function add_rating($customer_id, $shop_id, $rating_value, $review_comment) {
    $output = array();
    
    // تنظيف أي مخرجات سابقة
    if (ob_get_length()) ob_clean();
    
    // التحقق من البيانات المطلوبة
    if (empty($shop_id) || empty($customer_id) || empty($rating_value)) {
        $output['success'] = false;
        $output['message'] = "البيانات المطلوبة غير مكتملة";
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($output, JSON_UNESCAPED_UNICODE);
        exit;
    }
    
    try {
        // ✅ التأكد من وجود الجدول بالهيكل الصحيح
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS `ratings` (
                `id_rating` int(11) NOT NULL AUTO_INCREMENT,
                `shop_id` int(11) NOT NULL,
                `customer_id` int(11) NOT NULL,
                `rating_value` decimal(3,1) NOT NULL,
                `review_comment` text,
                `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (`id_rating`),
                KEY `shop_id` (`shop_id`),
                KEY `customer_id` (`customer_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        ");
        
        // ✅ التحقق من وجود تقييم سابق
        $checkSql = "SELECT id_rating FROM ratings WHERE shop_id = ? AND customer_id = ?";
        $checkStmt = $this->pdo->prepare($checkSql);
        $checkStmt->execute([$shop_id, $customer_id]);
        
        if ($checkStmt->rowCount() > 0) {
            // تحديث التقييم الموجود
            $updateSql = "UPDATE ratings SET rating_value = ?, review_comment = ? WHERE shop_id = ? AND customer_id = ?";
            $updateStmt = $this->pdo->prepare($updateSql);
            $result = $updateStmt->execute([$rating_value, $review_comment, $shop_id, $customer_id]);
            
            if ($result) {
                $output['success'] = true;
                $output['message'] = "تم تحديث التقييم بنجاح";
            } else {
                $error = $updateStmt->errorInfo();
                $output['success'] = false;
                $output['message'] = "خطأ في تحديث التقييم: " . $error[2];
            }
        } else {
            // إضافة تقييم جديد
            $insertSql = "INSERT INTO ratings (shop_id, customer_id, rating_value, review_comment) VALUES (?, ?, ?, ?)";
            $insertStmt = $this->pdo->prepare($insertSql);
            $result = $insertStmt->execute([$shop_id, $customer_id, $rating_value, $review_comment]);
            
            if ($result) {
                $output['success'] = true;
                $output['message'] = "تم إضافة التقييم بنجاح";
                $output['rating_id'] = $this->pdo->lastInsertId();
            } else {
                $error = $insertStmt->errorInfo();
                $output['success'] = false;
                $output['message'] = "خطأ في إضافة التقييم: " . $error[2];
            }
        }
        
    } catch (PDOException $e) {
        $output['success'] = false;
        $output['message'] = "خطأ في قاعدة البيانات: " . $e->getMessage();
    }
    
    // التأكد من إرجاع JSON فقط
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($output, JSON_UNESCAPED_UNICODE);
    exit;
}

}
?>