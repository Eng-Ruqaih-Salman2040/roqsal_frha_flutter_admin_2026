<?php


if ($_POST) {
    
    // ========== أزرار مقدم الخدمة (تعدل reservation_status) ==========
    
    // تأكيد مقدم الخدمة
    if (isset($_POST['Accept_provider'])) {
        $id = $_POST['id'];
        $reservation_status = '1'; // تأكيد
        
        try {
            include '../Model/M_reservations.php';
            $M_reservations = new M_reservations();
            
            $sql = "UPDATE `reservations` SET `reservation_status`='$reservation_status' WHERE `id`= '$id'";
            $M_reservations->Update_Data($sql);
            
            // إعادة التوجيه حسب نوع المستخدم
            if (isset($_SESSION['validity']) && $_SESSION['validity'] === "1") {
                @$Display = $M_reservations->Read_Data_Admin();
            } else {
                @$Display = $M_reservations->Read_Data_status0();
            }
            
            include '../View/reservations/index.php';
        } catch (\Throwable $th) {
            // معالجة الخطأ
        }
    }
    
    // رفض مقدم الخدمة
    if (isset($_POST['Delete_provider'])) {
        $id = $_POST['id'];
        $reservation_status = '2'; // رفض
        
        try {
            include '../Model/M_reservations.php';
            $M_reservations = new M_reservations();
            
            $sql = "UPDATE `reservations` SET `reservation_status`='$reservation_status' WHERE `id`= '$id'";
            $M_reservations->Update_Data($sql);
            
            // إعادة التوجيه حسب نوع المستخدم
            if (isset($_SESSION['validity']) && $_SESSION['validity'] === "1") {
                @$Display = $M_reservations->Read_Data_Admin();
            } else {
                @$Display = $M_reservations->Read_Data_status0();
            }
            
            include '../View/reservations/index.php';
        } catch (\Throwable $th) {
            // معالجة الخطأ
        }
    }
    
    // ========== أزرار المسؤول (تعدل A_reservation_status) ==========
    
    // تأكيد المسؤول
    if (isset($_POST['Accept_admin'])) {
        $id = $_POST['id'];
        $A_reservation_status = '1'; // تأكيد المسؤول
        
        try {
            include '../Model/M_reservations.php';
            $M_reservations = new M_reservations();
            
            $sql = "UPDATE `reservations` SET `A_reservation_status`='$A_reservation_status' WHERE `id`= '$id'";
            $M_reservations->Update_Data($sql);
            
            // إعادة التوجيه للأدمن
            @$Display = $M_reservations->Read_Data_Admin();
            
            include '../View/reservations/index.php';
        } catch (\Throwable $th) {
            // معالجة الخطأ
        }
    }
    
    // رفض المسؤول
    if (isset($_POST['Delete_admin'])) {
        $id = $_POST['id'];
        $A_reservation_status = '2'; // رفض المسؤول
        
        try {
            include '../Model/M_reservations.php';
            $M_reservations = new M_reservations();
            
            $sql = "UPDATE `reservations` SET `A_reservation_status`='$A_reservation_status' WHERE `id`= '$id'";
            $M_reservations->Update_Data($sql);
            
            // إعادة التوجيه للأدمن
            @$Display = $M_reservations->Read_Data_Admin();
            
            include '../View/reservations/index.php';
        } catch (\Throwable $th) {
            // معالجة الخطأ
        }
    }
    
    // تحديث مع الوقت (اختياري)
    if (isset($_POST['Update'])) {
        $id = $_POST['id'];
        $booking_time = $_POST['booking_time'];
        
        include '../Model/M_reservations.php';
        $M_reservations = new M_reservations();
        
        // التحقق من نوع التحديث
        if (isset($_POST['update_type']) && $_POST['update_type'] == 'admin') {
            // تحديث المسؤول
            $A_reservation_status = '1';
            $sql = "UPDATE `reservations` SET `booking_time` ='$booking_time', `A_reservation_status`='$A_reservation_status' WHERE `id`= '$id'";
        } else {
            // تحديث مقدم الخدمة
            $reservation_status = '1';
            $sql = "UPDATE `reservations` SET `booking_time` ='$booking_time', `reservation_status`='$reservation_status' WHERE `id`= '$id'";
        }
        
        $M_reservations->Update_Data($sql);
        
        // إعادة التوجيه حسب نوع المستخدم
        if (isset($_SESSION['validity']) && $_SESSION['validity'] === "1") {
            @$Display = $M_reservations->Read_Data_Admin();
        } else {
            @$Display = $M_reservations->Read_Data_status0();
        }
        
        include '../View/reservations/index.php';
    }

} else {
    // عرض البيانات عند تحميل الصفحة لأول مرة
    include '../Model/M_reservations.php';
    $M_reservations = new M_reservations();
    
    // التحقق من نوع المستخدم لعرض البيانات المناسبة
    if (isset($_SESSION['validity']) && $_SESSION['validity'] === "1") {
        @$Display = $M_reservations->Read_Data_Admin();
    } else {
        @$Display = $M_reservations->Read_Data_status0();
    }
    
    include '../View/reservations/index.php';
}
?>