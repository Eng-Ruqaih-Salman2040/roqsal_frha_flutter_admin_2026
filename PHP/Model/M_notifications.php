<?php

class M_notifications
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
            //code...
            include '../Model/Database.php';
            $vars = '../include/vars.php';
            $this->Database = new Database($vars);
        } catch (\Throwable $th) {
            throw new Exception("Error ", 1);
        }
    }

    public function Insert_Data($note, $date_create, $time_create)
{
    // التحقق من وجود أدمن مسجل دخول
    if (isset($_SESSION['getId_User']) && !empty($_SESSION['getId_User'])) {
        
        // رقم الأدمن من الجلسة
        $A_id = $_SESSION['getId_User'];
        
        // استعلام INSERT مع إضافة A_id
        $sql_Insert = "INSERT INTO `notifications` (`note`, `date_create`, `time_create`, `A_id`) 
                        VALUES ('$note', '$date_create', '$time_create', '$A_id')";
        
        if ($this->Database->Connect->query($sql_Insert) == true) {
            $this->Send_Firebase_Notification("إشعار جديد", $note);
            echo '<script> 
                Swal.fire({
                    title: "تم الحفظ بنجاح!",
                    text: "تمت إضافة الإشعار بواسطة: ' . $_SESSION['UserName'] . '",
                    type: "success",
                    confirmButtonClass: "btn btn-primary",
                    buttonsStyling: false,
                });
            </script>';
        } else {
            echo '<script>
                Swal.fire({
                    type: "error",
                    title: "خطأ في الإضافة",
                    text: "' . $this->Database->Connect->error . '",
                    confirmButtonClass: "btn btn-primary",
                    buttonsStyling: true,
                });
            </script>';
        }
        
    } else {
        echo '<script>
            Swal.fire({
                type: "error",
                title: "غير مسموح",
                text: "الرجاء تسجيل الدخول أولاً",
                confirmButtonClass: "btn btn-primary",
                buttonsStyling: true,
            });
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
	</script>'
	;
        }
    }

    public function Read_Data()
    {
        
        $sql="SELECT *FROM notifications";
                     
        $result = $this->Database->Connect->query($sql);
        if ($result->num_rows > 0) {

            $num = $result->num_rows;

            for ($i = 0; $i < $num; $i++) {
                # code...
                $data[$i] = mysqli_fetch_array($result);
            }

        }
        return $data;
    }
  
   

    public function Delete_Data($id)
    {

        $sql_DELETE = "DELETE FROM `notifications` WHERE `id` = '$id'  ";

        if ($this->Database->Connect->query($sql_DELETE) == true) {
             echo '<script> 
     Swal.fire({
        title: "تم الحذف بنجاح!",
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
	</script>'
	;
        }
    }

    public function Send_Firebase_Notification($title, $body)
    {
        require_once __DIR__ . '/../View/vendor/autoload.php'; // مكتبة JWT
        
        $serviceAccountFile = __DIR__ . '/../View/notifications/service-account1.json';
        if (!file_exists($serviceAccountFile)) {
            $serviceAccountFile = __DIR__ . '/../View/notifications/firebase_key.json';
        }
        
        if (!file_exists($serviceAccountFile)) {
            return false;
        }

        $serviceAccount = json_decode(file_get_contents($serviceAccountFile), true);

        $tokenUrl = "https://oauth2.googleapis.com/token";
        $now = time();
        $jwtClaim = [
            "iss" => $serviceAccount['client_email'],
            "scope" => "https://www.googleapis.com/auth/firebase.messaging",
            "aud" => $tokenUrl,
            "iat" => $now,
            "exp" => $now + 3600
        ];

        $privateKey = $serviceAccount['private_key'];
        $jwt = \Firebase\JWT\JWT::encode($jwtClaim, $privateKey, 'RS256');

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $tokenUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/x-www-form-urlencoded"]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion' => $jwt
        ]));
        $response = curl_exec($ch);
        curl_close($ch);

        $tokenData = json_decode($response, true);
        $accessToken = $tokenData['access_token'] ?? null;

        if(!$accessToken){
            return false;
        }

        $fcmUrl = "https://fcm.googleapis.com/v1/projects/{$serviceAccount['project_id']}/messages:send";

        $data = [
            "message" => [
                "topic" => "all",
                "notification" => [
                    "title" => $title,
                    "body" => $body
                ]
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $accessToken",
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        
        $result = curl_exec($ch);
        curl_close($ch);
        
        return true;
    }

}