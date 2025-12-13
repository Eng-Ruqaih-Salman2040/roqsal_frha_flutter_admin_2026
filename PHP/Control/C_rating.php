<?php

require_once('../Model/M_rating.php');
$M_rating = new Rating();

// استعلام حسب صلاحية المستخدم
if (isset($_SESSION['validity']) && $_SESSION['validity'] === "1") {
    $ratings = $M_rating->getAllRatingsWithCustomer();
} else {
    if (isset($_SESSION['getId_User'])) {
        $ratings = $M_rating->getRatingsWithCustomer($_SESSION['getId_User']);
    } else {
        die("⚠ غير مسموح لك بالوصول إلى هذه الصفحة");
    }
}

include('../View/rating/index.php');


// -------------------------
// تحديث (بلاغ reported)
// -------------------------
if (isset($_POST['Update'])) {

    $id = $_POST['id'];
    $reported = isset($_POST['reported']) ? 1 : 0;

    $sql = "UPDATE ratings SET reported='$reported' WHERE rating_id='$id'";
    $M_rating->Update_Data($sql);
}


// -------------------------
// حذف التقييم
// -------------------------
if (isset($_POST['Delete'])) {

    $id = $_POST['id'];
    $M_rating->Delete_Data($id);

}

