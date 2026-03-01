<?php

function checkImge() {
    if ($_FILES['imge']['name'] === "") {
        $MSG_imge[0] = "";
        $MSG_imge[1] = "default_image.png";
        $MSG_imge[2] = "default";
        return $MSG_imge;
    }
    $MSG_imge[0] = "";
    $imgFile = $_FILES['imge']['name'];
    $tmp_dir = $_FILES['imge']['tmp_name'];
    $imgSize = $_FILES['imge']['size'];
    //مسار حفظ الصورة الشخصية
    $upload_dir = '../../image/shop/';
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
    $MSG_imge[1] = rand(1000, 1000000) . "." . $imgExt;
    if (in_array($imgExt, $valid_extensions)) {
        // حجم الصورة تكون أقل من 9M
        if ($imgSize < 9000000) {
            move_uploaded_file($tmp_dir, $upload_dir . $MSG_imge[1]);
        } else {
            $MSG_imge[0] = "Sorry, your file is too large.";
        }
    } else {
        $MSG_imge[0] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }
    $MSG_imge[2] = "";
    return $MSG_imge;
}

function checkPdf() {
    $MSG_pdf[0] = "";
    
    // التأكد من وجود الملف
    if(!isset($_FILES['profession_license']) || $_FILES['profession_license']['error'] == 4) {
        $MSG_pdf[0] = "الرجاء اختيار ملف PDF";
        return $MSG_pdf;
    }
    
    $imgFile = $_FILES['profession_license']['name'];
    $tmp_dir = $_FILES['profession_license']['tmp_name'];
    $imgSize = $_FILES['profession_license']['size'];
    
    // مسار حفظ الملف
    $upload_dir = '../../pdf/profession_license/';
    
    // التأكد من وجود المجلد
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
    $valid_extensions = array('pdf');
    
    // إنشاء اسم فريد للملف
    $new_file_name = "profession_license_" . time() . "_" . rand(1000, 1000000) . "." . $imgExt;
    $MSG_pdf[1] = $new_file_name;
    
    if (in_array($imgExt, $valid_extensions)) {
        if ($imgSize < 900000000) { // 900 ميجابايت (كبير جداً! هل تقصد 9 ميجابايت؟)
            if(move_uploaded_file($tmp_dir, $upload_dir . $MSG_pdf[1])) {
                $MSG_pdf[0] = ""; // نجاح
            } else {
                $MSG_pdf[0] = "حدث خطأ في رفع الملف";
            }
        } else {
            $MSG_pdf[0] = "عذراً، حجم الملف كبير جداً. الحد الأقصى 9 ميجابايت";
        }
    } else {
        $MSG_pdf[0] = "عذراً، فقط ملفات PDF مسموح بها";
    }
    
    $MSG_pdf[2] = "";
    $MSG_pdf[3] = $imgSize;
    
    return $MSG_pdf;
}

if ($_POST) {
    
    // حفظ البيانات
    if (isset($_POST['Add'])) {
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $city_id = $_POST['city_id'];
        $section_id = $_POST['section_id'];
        $address = $_POST['address'];
        $rating_Admin = $_POST['rating_Admin'];

        if (isset($_POST['statues'])) 
            $statues = 1;
        else
            $statues = 0;

        $MSG_imge = checkImge();
        $MSG_pdf = checkPdf();

        try {
            include '../Model/M_shop.php';
            $M_shop = new M_shop();
            if ($MSG_imge[0] === "") {
                $M_shop->Insert_Data($user_name, $password, $city_id, $name, $phone, $email, $MSG_imge[1], $MSG_pdf[1], $price, $description, $statues, $address, $section_id, $rating_Admin);
                @$Display = $M_shop->Read_Data();
                @$Display_city = $M_shop->Read_Data_city();
                @$Display_section = $M_shop->Read_Data_section();
                include '../View/shop/index.php';
            } else {
                echo $MSG_imge[0] . 'هناك مشكلة في الصورة';
            }
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }
    
    // تحديث البيانات - تم تعديل المشكلة هنا
    if (isset($_POST['Update'])) {
        $id = $_POST['id'];
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        $city_id = $_POST['city_id'];
        
        // التحقق من وجود section_id
        if (isset($_POST['section_id']) && $_POST['section_id'] != "") {
            $section_id = $_POST['section_id'];
        } else {
            $section_id = 0; // قيمة افتراضية
            // يمكنك إضافة رسالة للمستخدم
            echo "<script>alert('تنبيه: لم يتم تحديد القسم، سيتم استخدام قيمة افتراضية');</script>";
        }
        
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $address = $_POST['address'];
        $rating_Admin = $_POST['rating_Admin'];

        if (isset($_POST['statues'])) 
            $statues = 1;
        else
            $statues = 0;
        
        $MSG_imge = checkImge();
        include '../Model/M_shop.php';
        $M_shop = new M_shop();
        
        if ($MSG_imge[1] != "default_image.png") {
            // ✅ تم التعديل هنا: إزالة علامات الاقتباس الفردية من حول rating_Admin و section_id
            $sql = "UPDATE `shop` SET  
                    `user_name` = '$user_name',
                    `password` = '$password',
                    `city_id` = '$city_id',
                    `name` = '$name',
                    `phone` = '$phone',
                    `email` = '$email',
                    `image` = '$MSG_imge[1]',
                    `price` = '$price',
                    `description` = '$description',
                    `statues` = '$statues',
                    `address` = '$address',
                    `section_id` = '$section_id',
                    `rating_Admin` = '$rating_Admin'	
                    WHERE `id` = '$id'";
            $M_shop->Update_Data($sql);
            @$Display = $M_shop->Read_Data();
            @$Display_city = $M_shop->Read_Data_city();
            @$Display_section = $M_shop->Read_Data_section();
            include '../View/shop/index.php';
        } else {
            // ✅ تم التعديل هنا: إزالة علامات الاقتباس الفردية من حول rating_Admin و section_id
            $sql = "UPDATE `shop` SET  
                    `user_name` = '$user_name',
                    `password` = '$password',
                    `city_id` = '$city_id',
                    `name` = '$name',
                    `phone` = '$phone',
                    `email` = '$email',
                    `price` = '$price',
                    `description` = '$description',
                    `statues` = '$statues',
                    `address` = '$address',
                    `section_id` = '$section_id',
                    `rating_Admin` = '$rating_Admin'	
                    WHERE `id` = '$id'";
            $M_shop->Update_Data($sql);
            @$Display = $M_shop->Read_Data();
            @$Display_city = $M_shop->Read_Data_city();
            @$Display_section = $M_shop->Read_Data_section();
            include '../View/shop/index.php';
        }
    }

    // حذف البيانات
    if (isset($_POST['Delete'])) {
        $id = $_POST['id'];
        try {
            include '../Model/M_shop.php';
            $M_shop = new M_shop();
            $M_shop->Delete_Data($id);
            @$Display = $M_shop->Read_Data();
            @$Display_city = $M_shop->Read_Data_city();
            @$Display_section = $M_shop->Read_Data_section();
            include '../View/shop/index.php';
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

} else {
    include ('../Model/M_shop.php');
    $M_shop = new M_shop();
    @$Display = $M_shop->Read_Data();
    @$Display_city = $M_shop->Read_Data_city();
    @$Display_section = $M_shop->Read_Data_section();
    
    include('../View/shop/index.php');
}
?>