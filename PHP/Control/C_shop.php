<?php

function checkImge() {
    $MSG_imge = array();
    
    // التحقق من وجود ملف الصورة
    if (!isset($_FILES['imge']) || $_FILES['imge']['name'] === "") {
        $MSG_imge[0] = "";
        $MSG_imge[1] = "default_image.png";
        $MSG_imge[2] = "default";
        return $MSG_imge;
    }
    
    $MSG_imge[0] = "";
    $imgFile = $_FILES['imge']['name'];
    $tmp_dir = $_FILES['imge']['tmp_name'];
    $imgSize = $_FILES['imge']['size'];
    $upload_dir = '../../image/shop/';
    
    // التأكد من وجود المجلد
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
    $MSG_imge[1] = rand(1000, 1000000) . "." . $imgExt;
    
    if (in_array($imgExt, $valid_extensions)) {
        if ($imgSize < 9000000) {
            if (!move_uploaded_file($tmp_dir, $upload_dir . $MSG_imge[1])) {
                $MSG_imge[0] = "فشل في رفع الصورة";
                $MSG_imge[1] = "default_image.png";
            }
        } else {
            $MSG_imge[0] = "عذراً، حجم الصورة كبير جداً. الحد الأقصى 9 ميجابايت";
            $MSG_imge[1] = "default_image.png";
        }
    } else {
        $MSG_imge[0] = "عذراً، فقط ملفات JPG, JPEG, PNG & GIF مسموح بها";
        $MSG_imge[1] = "default_image.png";
    }
    
    $MSG_imge[2] = "";
    return $MSG_imge;
}

function checkPdf() {
    $MSG_pdf = array();
    $MSG_pdf[0] = "";
    $MSG_pdf[1] = "";
    
    // التأكد من وجود الملف
    if(!isset($_FILES['profession_license']) || $_FILES['profession_license']['error'] == 4) {
        $MSG_pdf[0] = "";
        $MSG_pdf[1] = "";
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
        if ($imgSize < 9000000) {
            if(move_uploaded_file($tmp_dir, $upload_dir . $MSG_pdf[1])) {
                $MSG_pdf[0] = "";
            } else {
                $MSG_pdf[0] = "حدث خطأ في رفع الملف";
                $MSG_pdf[1] = "";
            }
        } else {
            $MSG_pdf[0] = "عذراً، حجم الملف كبير جداً. الحد الأقصى 9 ميجابايت";
            $MSG_pdf[1] = "";
        }
    } else {
        $MSG_pdf[0] = "عذراً، فقط ملفات PDF مسموح بها";
        $MSG_pdf[1] = "";
    }
    
    $MSG_pdf[2] = "";
    $MSG_pdf[3] = $imgSize;
    
    return $MSG_pdf;
}

if ($_POST) {
    
    // حفظ البيانات
    if (isset($_POST['Add'])) {
        $user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : 0;
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $city_id = isset($_POST['city_id']) ? $_POST['city_id'] : 0;
        $section_id = isset($_POST['section_id']) ? $_POST['section_id'] : 0;
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $rating_Admin = isset($_POST['rating_Admin']) ? $_POST['rating_Admin'] : 0;
        $cut = isset($_POST['cut']) ? $_POST['cut'] : 0;
        $latlng = isset($_POST['latlng']) ? $_POST['latlng'] : '';

        $statues = isset($_POST['statues']) ? 1 : 0;

        $MSG_imge = checkImge();
        $MSG_pdf = checkPdf();

        try {
            include '../Model/M_shop.php';
            $M_shop = new M_shop();
            
            $image = isset($MSG_imge[1]) ? $MSG_imge[1] : 'default_image.png';
            $pdf = isset($MSG_pdf[1]) ? $MSG_pdf[1] : '';
            
            if ($MSG_imge[0] === "") {
                $M_shop->Insert_Data(
                    $user_name, $password, $city_id, $name, $phone, $email, 
                    $image, $pdf, $price, $description, $statues, $address, 
                    $section_id, $rating_Admin,$cut,$latlng
                );
                
                @$Display = $M_shop->Read_Data();
                @$Display_city = $M_shop->Read_Data_city();
                @$Display_section = $M_shop->Read_Data_section();
                include '../View/shop/index.php';
            } else {
                echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "خطأ في الصورة",
                        text: "' . $MSG_imge[0] . '",
                        confirmButtonClass: "btn btn-primary",
                        buttonsStyling: true,
                    });
                </script>';
            }
        } catch (Exception $ex) {
            echo '<script>
                Swal.fire({
                    type: "error",
                    title: "خطأ",
                    text: "' . $ex->getMessage() . '",
                    confirmButtonClass: "btn btn-primary",
                    buttonsStyling: true,
                });
            </script>';
        }
    }
    
    // تحديث البيانات
    if (isset($_POST['Update'])) {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $city_id = isset($_POST['city_id']) ? $_POST['city_id'] : 0;
        $section_id = isset($_POST['section_id']) ? $_POST['section_id'] : 0;
        $name = isset($_POST['name']) ? $_POST['name'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $price = isset($_POST['price']) ? $_POST['price'] : 0;
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $rating_Admin = isset($_POST['rating_Admin']) ? $_POST['rating_Admin'] : 0;
        $cut = isset($_POST['cut']) ? $_POST['cut'] : 0;
        $latlng = isset($_POST['latlng']) ? $_POST['latlng'] : '';

        $statues = isset($_POST['statues']) ? 1 : 0;
        
        $MSG_imge = checkImge();
        include '../Model/M_shop.php';
        $M_shop = new M_shop();
        
        $image = isset($MSG_imge[1]) ? $MSG_imge[1] : 'default_image.png';
        
        if ($image != "default_image.png" && $MSG_imge[0] === "") {
            $sql = "UPDATE `shop` SET  
                    `user_name` = '$user_name',
                    `password` = '$password',
                    `city_id` = '$city_id',
                    `name` = '$name',
                    `phone` = '$phone',
                    `email` = '$email',
                    `image` = '$image',
                    `price` = '$price',
                    `description` = '$description',
                    `statues` = '$statues',
                    `address` = '$address',
                    `section_id` = '$section_id',
                    `rating_Admin` = '$rating_Admin',	
                    `cut` = '$cut',	
                    `latlng` = '$latlng'	
                    WHERE `id` = '$id'";
            $M_shop->Update_Data($sql);
        } else {
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
                    `rating_Admin` = '$rating_Admin',
                    `cut` = '$cut',	
                    `latlng` = '$latlng'
                    WHERE `id` = '$id'";
            $M_shop->Update_Data($sql);
        }
        
        @$Display = $M_shop->Read_Data();
        @$Display_city = $M_shop->Read_Data_city();
        @$Display_section = $M_shop->Read_Data_section();
        include '../View/shop/index.php';
    }

    // حذف البيانات
    if (isset($_POST['Delete'])) {
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        try {
            include '../Model/M_shop.php';
            $M_shop = new M_shop();
            $M_shop->Delete_Data($id);
            @$Display = $M_shop->Read_Data();
            @$Display_city = $M_shop->Read_Data_city();
            @$Display_section = $M_shop->Read_Data_section();
            include '../View/shop/index.php';
        } catch (\Throwable $th) {
            echo '<script>
                Swal.fire({
                    type: "error",
                    title: "خطأ",
                    text: "' . $th->getMessage() . '",
                    confirmButtonClass: "btn btn-primary",
                    buttonsStyling: true,
                });
            </script>';
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