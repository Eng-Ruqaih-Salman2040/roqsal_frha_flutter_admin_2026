<?php
class rating
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
    public function getRatingsWithCustomer($getId_User) {
        $getId_User = intval($getId_User);
        $sql = "SELECT 
                    ratings.rating_id,
                    ratings.rating_value,
                    ratings.review_comment,
                    ratings.created_time,
                    customers.name AS customer_name
                FROM ratings
                INNER JOIN customers ON ratings.customer_id = customers.id
                WHERE ratings.shop_id = $getId_User
                ORDER BY ratings.created_time DESC";
    
        $result = $this->Database->Connect->query($sql);
    
        $data = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        return $data;
    }
    
    public function getAllRatingsWithCustomer() {
    $sql = "SELECT 
                ratings.rating_id,
                ratings.rating_value,
                ratings.review_comment,
                ratings.created_time,
                ratings.shop_id,
                customers.name AS customer_name
            FROM ratings
            INNER JOIN customers ON ratings.customer_id = customers.id
            ORDER BY ratings.created_time DESC";

    $result = $this->Database->Connect->query($sql);

    $ratings = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ratings[] = $row;
        }
    }
    return $ratings;
}

public function Update_Data($sql)
{

    if ($this->Database->Connect->query($sql) == true) {
          echo '<script> 
          Swal.fire({
  title: "تم الإبلاغ بنجاح!",
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
public function Delete_Data($id)
{

    $sql_DELETE = "DELETE FROM `ratings` WHERE `rating_id` = '$id'  ";
  

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



}