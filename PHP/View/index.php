<?php 
session_start();
if ($_SESSION['UserName'] == "") {
   // header('Location:../control/C_Login.php');
   header('Location: ../control/C_Login_User.php');
    //header('Location: ../control/C_Login_Admin.php');
    exit; // Add exit after header redirect
} else {

}
  // session_start();
   // $_SESSION['UserName']="a";
	//echo $_SESSION['UserName']; ?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">

	<title>Dashboard analytics - Vuexy - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
	
	

    
    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../app-assets/vendors/css/vendors-rtl.min.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/vendors/css/extensions/tether-theme-arrows.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/vendors/css/extensions/tether.min.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/vendors/css/extensions/shepherd-theme-default.css">
  <link rel="stylesheet" type="text/css" href="../../app-assets/vendors/css/tables/datatable/datatables.min.css">
     
   <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../app-assets/css-rtl/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/css-rtl/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/css-rtl/colors.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/css-rtl/components.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/css-rtl/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/css-rtl/themes/semi-dark-layout.css">

	
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../app-assets/css-rtl/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/css-rtl/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/css-rtl/pages/dashboard-analytics.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/css-rtl/pages/card-analytics.css">
    <link rel="stylesheet" type="text/css" href="../../app-assets/css-rtl/plugins/tour/tour.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../app-assets/css-rtl/custom-rtl.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/style-rtl.css">
    <!-- END: Custom CSS-->

	
	    <link rel="apple-touch-icon" href="../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="../../app-assets/css-rtl/plugins/forms/validation/form-validation.css">
    <!-- END: Page CSS-->

	
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body id="p" class="vertical-layout vertical-menu-modern  
 
<?php
//echo "dark-layout";
if(isset($_SESSION['layout_them']) && $_SESSION['layout_them']==="1")
echo "dark-layout";
?>
 2-columns  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="dark-layout">

  <!-- BEGIN: Header-->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">خروج؟</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">حدد "تسجيل الخروج" أدناه إذا كنت مستعدًا لإنهاء جلستك الحالية.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">إلغاء</button>
						<?php 
				if(isset($_SESSION['validity']) && $_SESSION['validity']==="0"){
                    $l="User";
					}
					if(isset($_SESSION['validity']) && $_SESSION['validity']==="1"){
                    $l="Admin";
					}?>
					
					<a class="btn btn-primary" href="../Control/C_Login_<?php echo $l;?>.php">خروج</a>
			
                </div>
            </div>
        </div>
    </div>
	<?php
	
       include('layout/header.php'); 
?>
   <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
		<?php
       // Set default page if not set to avoid errors in main_menu.php
       if (!isset($_GET['page1'])) {
           $_GET['page1'] = 'Dashboard';
       }
       include('layout/main_menu.php'); 
?>	
     <!-- END: Main Menu-->



    <!-- BEGIN: Content-->
	
	<?php
	
if ($_GET) {

    if (isset($_GET['page1'])) {
	    $url = ""; // Initialize variable
        if ($_GET['page1'] === "Logout") {
            $url = $_GET['page1'].".php";
        } else {
			 include('../Control/C_'.$_GET['page1'].'.php'); 	
			 // $url = '../Control/C_'.$_GET['page1'].'.php";
        }
 if (isset($url) && $url !== "")
        if (is_file($url)) {
			
				if($_GET['page1']==="Dashboard"){
		    include $url;
				}else{
				echo "<div class='row'>";
            include $url;
				echo "</div>";	
				}
        } else {
            echo "ERROR";
        }
		
          
    }
   
} else {
	 include('../Control/C_Dashboard.php'); 	
			
	     
}

?>  
  <!-- END: Content-->

   
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">حقوق النشر &copy; 2024<a class="text-bold-800 grey darken-2" href="" target="_blank">فرحة,</a>كل الحقوق محفوظة</span><span class="float-md-right d-none d-md-block">جامعة الرازي<i class="feather icon-heart pink"></i></span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="feather icon-arrow-up"></i></button>
        </p>
    </footer>
    <!-- END: Footer-->
 
 <!-- BEGIN: Vendor JS-->
    <script src="../../app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="../../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="../../app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="../../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../../app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="../../app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../app-assets/js/core/app-menu.js"></script>
    <script src="../../app-assets/js/core/app.js"></script>
    <script src="../../app-assets/js/scripts/components.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../app-assets/js/scripts/datatables/datatable.js"></script>
    <!-- END: Page JS-->

	
	

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Page JS-->
    <script src="../../app-assets/js/scripts/forms/validation/form-validation.js"></script>
    <!-- END: Page JS-->
 <script src='../../app-assets/vendors/js/extensions/sweetalert2.all.min.js'></script>
			
			
</body>
<!-- END: Body-->

</html>