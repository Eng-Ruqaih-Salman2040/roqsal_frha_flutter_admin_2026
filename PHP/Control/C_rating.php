
<!-- include ('../Model/M_rating.php');
      $M_rating = new rating();
      @$Display = $M_rating->getRatingsWithCustomer();
      include('../View/rating/index.php'); -->
<?php
// include ('../Model/M_rating.php');
// @session_start();

// $M_rating = new Rating();

// // تحقق أن المستخدم أدمن فقط
// if(isset($_SESSION['validity']) && $_SESSION['validity']==="1") {
//     // الأدمن يشوف كل التقييمات
//     $ratings = $M_rating->getAllRatingsWithCustomer();
    
// } else {
//     $ratings = $M_rating->getRatingsWithCustomer($shop_id);
//     // die("غير مسموح لك بالوصول إلى هذه الصفحة");
// }

// include('../View/rating/index.php');

include ('../Model/M_rating.php');

$M_rating = new Rating();


if (isset($_SESSION['validity']) && $_SESSION['validity'] === "1") {

    
    $ratings = $M_rating->getAllRatingsWithCustomer();

} else {

   
    if (isset($_SESSION['getId_User'])) {
        $getId_User = $_SESSION['getId_User'];
        $ratings = $M_rating->getRatingsWithCustomer($getId_User);
    } else {
        die("⚠ غير مسموح لك بالوصول إلى هذه الصفحة");
    }
}

include('../View/rating/index.php');
