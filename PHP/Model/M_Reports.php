<?php
class M_Reports
{
    private $Database;

    public function __construct()
    {
        $this->connectDB();
    }

    private function connectDB()
    {
        try {
            include '../Model/Database.php';
            $vars = '../include/vars.php';
            $this->Database = new Database($vars);
        } catch (\Throwable $th) {
            throw new Exception("Error connecting to database", 1);
        }
    }
    public $last_query = "";

    /**
     * جلب كافة الحجوزات لمدير النظام (بكل المتاجر) مع إمكانية الفلترة بحالة الحجز والتاريخ
     */
    public function get_Admin_Bookings($status_value = 'all', $date_from = '', $date_to = '')
    {
        $data = [];
        
        // الاستعلام الأساسي لجلب حجوزات جميع المتاجر
        $sql = "SELECT r.id, r.booking_date, r.reservation_status, r.note, r.bond_no,
                       c.name, c.email, c.phone,
                       h.name as 'shop_name', h.price, h.phone as 'shop_phone',
                       b.account_name 
                FROM reservations r, customers c, shop h, bank_accounts b, bank_accounts_user b_user 
                WHERE b.id = b_user.bank_accounts_id 
                  AND c.id = r.customers_id 
                  AND h.id = r.shop_id 
                  AND b_user.id = r.bank_accounts_user_id";

        // إذا لم يكن الفلتر 'كل الحجوزات', نضيف شرط الحالة
        if ($status_value !== 'all') {
            $safe_status = $this->Database->Connect->real_escape_string($status_value);
            $sql .= " AND r.reservation_status = '$safe_status'";
        }

        // فلترة (من تاريخ)
        if (!empty($date_from)) {
            $safe_date_from = $this->Database->Connect->real_escape_string($date_from);
            $sql .= " AND DATE(r.booking_date) >= '$safe_date_from'";
        }

        // فلترة (إلى تاريخ)
        if (!empty($date_to)) {
            $safe_date_to = $this->Database->Connect->real_escape_string($date_to);
            $sql .= " AND DATE(r.booking_date) <= '$safe_date_to'";
        }

        // ترتيب الحجوزات من الأحدث للأقدم مثلا
        $sql .= " ORDER BY r.id DESC";
        $this->last_query = $sql;

        $result = $this->Database->Connect->query($sql);
        
        if ($result && $result->num_rows > 0) {
            $num = $result->num_rows;
            for ($i = 0; $i < $num; $i++) {
                $data[$i] = mysqli_fetch_array($result);
            }
        }
        return $data;
    }

    /**
     * تقرير الخدمات (المتاجر)
     */
    public function get_Shop_Report($status = 'all', $date_from = '', $date_to = '') {
        $data = [];
        $sql = "SELECT id, name, phone, email, price, statues, address FROM shop";
        
        $conditions = [];
        if ($status !== 'all') {
            $safe_status = $this->Database->Connect->real_escape_string($status);
            $conditions[] = "statues = '$safe_status'";
        }

        // الكشف الديناميكي عن اسم عمود التاريخ
        $date_col = "";
        $col_result = $this->Database->Connect->query("SHOW COLUMNS FROM `shop`");
        if ($col_result) {
            while($col = $col_result->fetch_assoc()) {
                if(in_array(strtolower($col['Field']), ['date_create', 'booking_date', 'created_at', 'date', 'register_date', 'created_time', 'time_create'])) {
                    $date_col = $col['Field'];
                    break;
                }
            }
        }

        if ($date_col != "") {
            if (!empty($date_from)) {
                $safe_from = $this->Database->Connect->real_escape_string($date_from);
                $conditions[] = "DATE(`$date_col`) >= '$safe_from'";
            }
            if (!empty($date_to)) {
                $safe_to = $this->Database->Connect->real_escape_string($date_to);
                $conditions[] = "DATE(`$date_col`) <= '$safe_to'";
            }
        }

        if (count($conditions) > 0) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $sql .= " ORDER BY id DESC";
        $result = $this->Database->Connect->query($sql);
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) { 
                $data[] = $row; 
            }
        }
        return $data;
    }

    /**
     * جلب التقارير العامة لكونها جداول بسيطة
     */
    public function get_Generic_Report($entity, $date_from = '', $date_to = '') {
        $data = [];
        $allowed_entities = [
            'section' => 'section',
            'city' => 'city',
            'bank_accounts' => 'bank_accounts',
            'rating' => 'ratings', // المعالجة الدقيقة لخطأ اختلاف اسم الجدول
            'Technical_Support' => 'Technical_Support',
            'ads' => 'ads'
        ];
        
        if (!array_key_exists($entity, $allowed_entities)) return [];
        $table = $allowed_entities[$entity];
        
        $sql = "SELECT * FROM `". $table ."`";
        
        $conditions = [];
        // الكشف الديناميكي عن اسم عمود التاريخ والمفتاح الرئيسي لضمان الترتيب
        $date_col = "";
        $pk_col = "id"; // افتراضي
        
        $col_result = $this->Database->Connect->query("SHOW COLUMNS FROM `$table`");
        if ($col_result) {
            $first = true;
            while($col = $col_result->fetch_assoc()) {
                if ($first || $col['Key'] == 'PRI') {
                    $pk_col = $col['Field'];
                    if ($col['Key'] == 'PRI') $first = false;
                }
                if(in_array(strtolower($col['Field']), ['date_create', 'booking_date', 'created_at', 'date', 'register_date', 'created_time', 'time_create'])) {
                    $date_col = $col['Field'];
                }
            }
        }

        if ($date_col != "") {
            if (!empty($date_from)) {
                $safe_from = $this->Database->Connect->real_escape_string($date_from);
                $conditions[] = "DATE(`$date_col`) >= '$safe_from'";
            }
            if (!empty($date_to)) {
                $safe_to = $this->Database->Connect->real_escape_string($date_to);
                $conditions[] = "DATE(`$date_col`) <= '$safe_to'";
            }
        }

        if (count($conditions) > 0) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $sql .= " ORDER BY `$pk_col` DESC";
        $result = $this->Database->Connect->query($sql);
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) { 
                $data[] = $row; 
            }
        }
        return $data;
    }
}
?>