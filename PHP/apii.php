<?php
// منع عرض أي أخطاء
error_reporting(0);
ini_set('display_errors', 0);

// تعيين header JSON - هذا مهم جداً
header('Content-Type: application/json');

// استقبال الرسالة من Flutter
$input = json_decode(file_get_contents('php://input'), true);
$client_message = isset($input['message']) ? $input['message'] : "أريد حفلة زفاف لـ 200 شخص بميزانية 2000000 ريال";

// رابط الـ API
$url = "http://127.0.0.1:8000/ai-event/";

// تحويلها إلى JSON
$data = json_encode(array("message" => $client_message));

// تهيئة cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'
));
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

// إرسال الطلب واستلام الرد
$response = curl_exec($ch);

// التحقق من وجود أخطاء في cURL
if(curl_error($ch)) {
    $error_response = array(
        "message" => "خطأ في الاتصال بالخادم",
        "error" => curl_error($ch),
        "services" => array(),
        "total_cost" => 0,
        "remaining_budget" => 0
    );
    echo json_encode($error_response, JSON_UNESCAPED_UNICODE);
    curl_close($ch);
    exit;
}

// إغلاق الاتصال
curl_close($ch);

// التحقق من الرد
if ($response === false) {
    $error_response = array(
        "message" => "لم يتم استلام رد من الخادم",
        "services" => array(),
        "total_cost" => 0,
        "remaining_budget" => 0
    );
    echo json_encode($error_response, JSON_UNESCAPED_UNICODE);
    exit;
}

// محاولة تحويل الرد من JSON
$result = json_decode($response, true);

// التحقق من نجاح تحويل JSON
if ($result === null) {
    // إذا فشل التحويل، نعيد الرد الأصلي مع رسالة خطأ
    $error_response = array(
        "message" => "تم الاستلام ولكن الرد ليس JSON صحيح",
        "raw_response" => $response,
        "services" => array(),
        "total_cost" => 0,
        "remaining_budget" => 0
    );
    echo json_encode($error_response, JSON_UNESCAPED_UNICODE);
} else {
    // إذا نجح التحويل، نعيد البيانات بشكل JSON
    // يمكنك هنا تعديل الرد حسب احتياجك
    $formatted_response = array(
        "message" => isset($result['message']) ? $result['message'] : "حدث خطأ اثناء الاتصال بالخادم:",
        "services" => isset($result['services']) ? $result['services'] : array(),
        "total_cost" => isset($result['total_cost']) ? $result['total_cost'] : 0,
        "remaining_budget" => isset($result['remaining_budget']) ? $result['remaining_budget'] : 0
    );
    
    echo json_encode($formatted_response, JSON_UNESCAPED_UNICODE);
}
?>