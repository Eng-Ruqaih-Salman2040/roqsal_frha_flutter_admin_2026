<?php

class M_reservations
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

    public function Insert_Data($name, $statues)
    {
        $sql_Insert="INSERT INTO `reservations` (`id`, `name`, `statues`)
        VALUES ('null','$name', '$statues') ";
        if ($this->Database->Connect->query($sql_Insert) == true) {
            echo '<script> 
                 Swal.fire({
      title: "تم الحفظ بنجاح!",
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

    public function Read_Data_status0()
    {
        $id=$_SESSION['getId_User'];
        $sql="SELECT r.id,r.booking_date,r.reservation_status,r.note,r.bond_no, c.name,c.email,c.phone, b.account_name FROM reservations r,customers c,bank_accounts b,bank_accounts_user b_user WHERE b.id = b_user.bank_accounts_id and c.id = r.customers_id and b_user.id = r.bank_accounts_user_id and reservation_status=0 and r.shop_id=$id"; 
                     
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
    public function Read_Data_status1()
    {
       $id=$_SESSION['getId_User'];
        $sql="SELECT r.id,r.booking_date,r.reservation_status,r.note,r.bond_no, c.name,c.email,c.phone, b.account_name FROM reservations r,customers c,bank_accounts b,bank_accounts_user b_user WHERE b.id = b_user.bank_accounts_id and c.id = r.customers_id and b_user.id = r.bank_accounts_user_id and reservation_status=1 and r.shop_id=$id"; 
      
                     
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
    public function Read_Data_status2()
    {
        $id=$_SESSION['getId_User'];
        $sql="SELECT r.id,r.booking_date,r.reservation_status,r.note,r.bond_no, c.name,c.email,c.phone, b.account_name FROM reservations r,customers c,bank_accounts b,bank_accounts_user b_user WHERE b.id = b_user.bank_accounts_id and c.id = r.customers_id and b_user.id = r.bank_accounts_user_id and reservation_status=2 and r.shop_id=$id"; 
      
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
	    public function Read_Data_status3()
    {
        $sql="SELECT r.id,r.booking_date,r.reservation_status,r.note,r.bond_no,
c.name,c.email,c.phone,
h.name as 'shop_name',h.price,h.phone as 'shop_phone',
b.account_name FROM reservations r,customers c,shop h,bank_accounts b,bank_accounts_user b_user WHERE b.id = b_user.bank_accounts_id and c.id = r.customers_id and h.id = r.shop_id and b_user.id = r.bank_accounts_user_id


"; 
     
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
  
   

  

}