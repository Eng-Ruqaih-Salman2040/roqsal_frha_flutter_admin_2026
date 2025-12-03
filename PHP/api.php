<?php
include 'include/vars.php';
        $opration=new Opration();
      define('conString','mysql:host='.$host.';dbname='.$database.';charset=utf8');
        define('dbUser',$userName);
        define('dbPass',$password);
		
      
		
        $opration->dbConnect(conString,dbUser,dbPass);
        $checkwhat=$_REQUEST["checkopration"];
		
		switch($checkwhat){
			
        case'Login':
	//	http://localhost/RoqSal_Farah_Api_Admin/PHP/api.php?id_user=363&password=123456&checkopration=Login
		$name=$_REQUEST["name"];
		$password=$_REQUEST["password"];

	   $opration->Login($name,$password);
        break;
		
			case'load_Data_section':
		
	   $opration->load_Data_section();
        break;
		case'load_Data_Ads':
		
	   $opration->load_Data_Ads();
        break;
		case'load_Data_Notifications':
		
	   $opration->load_Data_Notifications();
        break;
		
		case'load_Data_reservations':
		//http://localhost/wedding/PHP/api.php?id=2&checkopration=load_Data_reservations
			$id=$_REQUEST['id'];
				$reservation_status=$_REQUEST['reservation_status'];
		
	   $opration->load_Data_reservations($id,$reservation_status);
        break;
		
	case'load_Data_Bank_accounts':
		
	   $opration->load_Data_Bank_accounts();
        break;
	
	
    case'Reserve_shop':
	//http://localhost/wedding/PHP/api.php?customers_id=1&bank_id=1&bond_no=1111&shop_id=3&note=nnnn&booking_date=2020-10-88&checkopration=Reserve_shop
        $customers_id=$_REQUEST['customers_id'];
		$bank_id=$_REQUEST['bank_id'];
		$bond_no=$_REQUEST['bond_no'];
		$shop_id=$_REQUEST['shop_id'];
		$note=$_REQUEST['note'];
		$booking_date=$_REQUEST['booking_date'];
				 
		$opration->Reserve_shop($customers_id,$bank_id,$bond_no,$shop_id,$note,$booking_date);
        
		break;
		
		
	case'load_Data_shop':
		$section_id=$_REQUEST['section_id'];
		
	   $opration->load_Data_shop($section_id);
        break;
		
		case'PaymentMethod':
		$shop_id=$_REQUEST['shop_id'];
	 $opration->PaymentMethod($shop_id);
        break;
		case'gallery':
		$shop_id=$_REQUEST['shop_id'];
	 $opration->gallery($shop_id);
        break;
		
			case'Technical_Support':
$name=$_REQUEST['name'];
$email=$_REQUEST['email'];
$subject=$_REQUEST['subject'];
$message=$_REQUEST['message'];

	   $opration->Technical_Support($name,$email,$subject,$message);
	 break;
			case'view':
			//http://localhost/Wedding_Control/PHP/api.php?id_shop=1&checkopration=view
		$shop_id=$_REQUEST['shop_id'];
	 $opration->view($shop_id);
        break;
		
	
			case'Sign_Up':
				//http://localhost/Wedding_Control/PHP/api.php?name=1&pass=1&phone=1&email=1&checkopration=Sign_Up
		
		$name=$_REQUEST['name'];
		$pass=$_REQUEST['pass'];
		$phone=$_REQUEST['phone'];
		$email=$_REQUEST['email'];
		
	 $opration->Sign_Up($name,$pass,$phone,$email);
        break;
		
	
default:
        }

         class Opration {
    private $pdo;

    public function dbConnect($conString, $user, $pass) {
        try {
            $pdo = new PDO($conString, $user, $pass);
            $this -> pdo = $pdo;
            return true;
        } catch (PDOException $e) {
            $this -> msg = 'Connection did not work out!';
            return false;
        }
    }

	    public function load_Data_Ads() {
		
        $output['ads'] = array();
        $result = $this -> pdo-> prepare("SELECT *FROM ads  ORDER BY `id`");
        if ($result -> execute()) {
            while ($row = $result -> fetch()) {
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
            $error = $result -> errorInfo();
            $output['success'] = false;
            $output['message'] = "error".$error[2];
        }
        echo json_encode ($output);
    }

	    public function load_Data_Notifications() {
		
        $output['notifications'] = array();
        $result = $this -> pdo-> prepare("SELECT *FROM 	notifications ORDER BY `id`");
        if ($result -> execute()) {
            while ($row = $result -> fetch()) {
                $index['id'] = $row['id'];
                $index['note'] = $row['note'];
			    $index['date_create'] = $row['date_create'];
			    $index['time_create'] = $row['time_create'];
				
                array_push($output['notifications'], $index);
            }
            $output['success'] = true;
            $output['message'] = "success";
        } else {
            $error = $result -> errorInfo();
            $output['success'] = false;
            $output['message'] = "error".$error[2];
        }
        echo json_encode ($output);
    }

    public function load_Data_reservations($id,$reservation_status) {
		
        $output['reservations'] = array();
        $result = $this -> pdo-> prepare("SELECT section.name as 'section_name' ,reservations.id,reservations.booking_date,reservations.reservation_status,reservations.note,reservations.bond_no,
customers.email,customers.phone,
bank_accounts.account_name,shop.name,shop.image,shop.price
FROM reservations ,shop ,customers ,bank_accounts ,bank_accounts_user,section  WHERE  shop.section_id = section.id and shop.id = reservations.shop_id and customers.id = reservations.customers_id and bank_accounts_user.id = reservations.bank_accounts_user_id and reservations.reservation_status=$reservation_status and bank_accounts_user.bank_accounts_id = bank_accounts.id and customers.id=$id");
        if ($result -> execute()) {
            while ($row = $result -> fetch()) {
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
            $error = $result -> errorInfo();
            $output['success'] = false;
            $output['message'] = "error".$error[2];
        }
        echo json_encode ($output);
    }
	
	
	 public function load_Data_shop($section_id) {
		 
        $output['shop'] = array();
        $result = $this -> pdo-> prepare("SELECT shop.*,city.name as 'city_name',section.name as 'section_name' FROM shop,city,section WHERE city.id = shop.city_id and section.id = shop.section_id and  shop.statues =1 and  shop.section_id='$section_id'");
        if ($result -> execute()) {
            while ($row = $result -> fetch()) {
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
            $error = $result -> errorInfo();
            $output['success'] = false;
            $output['message'] = "error".$error[2];
        }
        echo json_encode ($output);
    }

		 public function load_Data_section() {
		 
        $output['section'] = array();

      
        $result = $this -> pdo-> prepare("SELECT  section.*,(SELECT COUNT(*) FROM shop WHERE  shop.statues=1 and shop.section_id = section.id) AS count_shop FROM section where status=1 ORDER BY sort,name ASC");
        if ($result -> execute()) {
            while ($row = $result -> fetch()) {
                $index['id'] = $row['id'];
                $index['name'] = $row['name'];
                $index['image'] = $row['image'];
                $index['count_shop'] = $row['count_shop'];

     
                array_push($output['section'], $index);
            }
            $output['success'] = true;
            $output['message'] = "success";
        } else {
            $error = $result -> errorInfo();
            $output['success'] = false;
            $output['message'] = "error".$error[2];
        }
        echo json_encode ($output);
    }

	
	
   public function PaymentMethod($shop_id) {
		
        $output['PaymentMethod'] = array();
		
         
        $result = $this -> pdo-> prepare("SELECT bank_user.id,bank_user.bank_accounts_id,bank_user.shop_id,bank_user.account_number,bank_user.statues
		,bank.imge,bank.account_name FROM bank_accounts_user bank_user,bank_accounts bank where bank_user.bank_accounts_id=bank.id and  bank_user.statues='1' and  shop_id=$shop_id");
        if ($result -> execute()) {
            while ($row = $result -> fetch()) {
                $index['id'] = $row['id'];
                $index['imge'] = $row['imge'];
                $index['account_name'] = $row['account_name'];
			    $index['account_number'] = $row['account_number'];
			  	
                array_push($output['PaymentMethod'], $index);
            }
            $output['success'] = true;
            $output['message'] = "success";
        } else {
            $error = $result -> errorInfo();
            $output['success'] = false;
            $output['message'] = "error".$error[2];
        }
        echo json_encode ($output);
    }

	
	  public function gallery($shop_id) {
		
        $output['gallery'] = array();
		
         
        $result = $this -> pdo-> prepare("SELECT *FROM gallery where status='1' and shop_id=$shop_id");
        if ($result -> execute()) {
            while ($row = $result -> fetch()) {
                $index['id'] = $row['id'];
                $index['imge'] = $row['file_name'];
            
			  	
                array_push($output['gallery'], $index);
            }
            $output['success'] = true;
            $output['message'] = "success";
			
			////////
			
			
			
			      
        $resultv = $this -> pdo-> prepare("SELECT *FROM shop WHERE id='$shop_id'");
        if ($resultv -> execute()) {
            while ($row = $resultv -> fetch()) {
        	$v=$row['viewer']+1;
    	$result2 = $this -> pdo -> prepare("UPDATE shop SET  	viewer ='$v' WHERE id='$shop_id'");		  
				
            if ($result2 -> execute()) {
             
   } 
    
    
    
             }
        }
			
			
			
			
			////////////
			
			
        } else {
            $error = $result -> errorInfo();
            $output['success'] = false;
            $output['message'] = "error".$error[2];
        }
        echo json_encode ($output);
    }

	
	public function Reserve_shop($customers_id,$bank_id,$bond_no,$shop_id,$note,$booking_date){
	
 $result = $this -> pdo -> prepare("SELECT * FROM reservations  WHERE shop_id='$shop_id' and booking_date='$booking_date' ");


        if ($result -> execute()) {
        if($row = $result -> fetch(PDO::FETCH_ASSOC))
    {
                $output['success'] = true;
                $output['message'] = "success";
				
				$output['reservation_check'] = false;
		  

       
    }
    else
    {
              $output['success'] = false;
                $output['message'] = "error";
				$output['reservation_check'] = true;
					$sql_Insert =  "INSERT INTO `reservations` (`id`, `bank_accounts_user_id`, `shop_id`, `customers_id`, `booking_date`, `reservation_status`, `note`, `bond_no`)
	VALUES (NULL, '$bank_id', '$shop_id', '$customers_id', '$booking_date', '0','$note','$bond_no' );";
		                 
			  $stmt = $this->pdo->prepare($sql_Insert); 
                if($stmt->execute()){ 
           $output['success'] = true;
		  
           $output['message'] = "تم ارسال الطلب بنجاح";
				}
			 
              	 else {
		    
			$error = $stmt -> errorInfo();
            $output['success'] = false;
		    $output['message'] = "error:".$error[2];
				
				$output['reservation_check'] = true;
		  
	   }
    }
            } else {
                $output['success'] = false;
                $output['message'] = "errord";
				$output['reservation_check'] = true;
            }
        echo json_encode ($output);
		
  
    }

	public function Login($name, $password) {

        $output = array();

 $result = $this -> pdo -> prepare("SELECT * FROM customers WHERE  	name='$name' and password='$password' ");


        if ($result -> execute()) {
        if($row = $result -> fetch(PDO::FETCH_ASSOC))
    {
                $output['id'] = $row['id'];
                $output['imge'] = $row['imge'];
                $output['name'] = $row['name'];
                $output['password'] = $row['password'];
                $output['phone'] = $row['phone'];
                $output['email'] = $row['email'];
                $output['date_register'] = $row['date_register'];
                $output['success'] = true;
                $output['message'] = "success";
    }
    else
    {
              $output['success'] = false;
                $output['message'] = "error";
    }
            } else {
                $output['success'] = false;
                $output['message'] = "errord";
            }
        
        echo json_encode ($output);
    }
  
  
	 public function Technical_Support($name,$email,$subject,$message) {
	   $dt = new DateTime();
$date_register=$dt->format('Y-m-d');
$time_create=$dt->format('H:i:s');

        $output = array();
		   
  $sql_Insert="INSERT INTO `Technical_Support` (`id`, `name`, `email`, `subject`
		, `message`, `status`, `date_create`, `time_create`)
        VALUES ('null','$name', '$email','$subject'
		,'$message','0','$date_register','$time_create') ";

        $result = $this -> pdo-> prepare($sql_Insert);
        if ($result -> execute()) {

                $output['success'] = true;
                $output['message'] = "success";
      } else {
            $error = $result -> errorInfo();
            $output['success'] = false;
            $output['message'] = "error".$error[2];
        }
        echo json_encode ($output);
		
	
	 
	 }
	 public function Sign_Up($name,$pass,$phone,$email) {
	 
        $output = array();
		      $sql_Insert="INSERT INTO `customers` (`id`, `imge`, `name`, `password`, `phone`
		, `email`, `date_register`)
        VALUES ('null','256292.png', '$name', '$pass','$phone','$email','2020-11-15') ";

 
        $result = $this -> pdo-> prepare($sql_Insert);
        if ($result -> execute()) {
         $result = $this -> pdo -> prepare("SELECT * FROM customers WHERE  	phone='$phone' and password='$pass' ");


        if ($result -> execute()) {
        if($row = $result -> fetch(PDO::FETCH_ASSOC))
    {
                $output['customers_id'] = $row['id'];
                $output['imge'] = $row['imge'];
                $output['name'] = $row['name'];
                $output['password'] = $row['password'];
                $output['phone'] = $row['phone'];
                $output['email'] = $row['email'];
                $output['date_register'] = $row['date_register'];
                $output['success'] = true;
                $output['message'] = "success";
    }
    else
    {
              $output['success'] = false;
                $output['message'] = "error";
    }
            } else {
                $output['success'] = false;
                $output['message'] = "errord";
            }
        } else {
            $error = $result -> errorInfo();
            $output['success'] = false;
            $output['message'] = "error".$error[2];
        }
        echo json_encode ($output);
		
	
	 
	 }
	
		 }
	
?>