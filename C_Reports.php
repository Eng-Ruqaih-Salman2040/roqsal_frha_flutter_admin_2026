<?php
// Control/C_Reports.php
include_once('../Model/M_Reports.php');

$reportsModel = new M_Reports();

// استلام الفلاتر من الفورم
$report_entity = isset($_POST['report_entity']) ? $_POST['report_entity'] : 'reservations';

$dateFrom    = isset($_POST['date_from']) ? $_POST['date_from'] : '';
$dateTo      = isset($_POST['date_to']) ? $_POST['date_to'] : '';

$bookings = [];

if ($report_entity == 'reservations') {
    // حالة الحجوزات
    $serviceType = isset($_POST['service_type']) ? $_POST['service_type'] : 'all';
    $bookings = $reportsModel->get_Admin_Bookings($serviceType, $dateFrom, $dateTo);
} elseif ($report_entity == 'shop') {
    // حالة الخدمات
    $shopStatus = isset($_POST['shop_status']) ? $_POST['shop_status'] : 'all';
    $bookings = $reportsModel->get_Shop_Report($shopStatus, $dateFrom, $dateTo);
} else {
    // التقارير الأخرى المبسطة
    $bookings = $reportsModel->get_Generic_Report($report_entity, $dateFrom, $dateTo);
}

// تمرير البيانات إلى الـ View
include('../View/Reports.php');
?>