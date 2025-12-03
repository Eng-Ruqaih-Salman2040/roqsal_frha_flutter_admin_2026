 
  
  <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
				      <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                        </ul>
                  
               
                    </div>
               
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
		
                    </div>
                    <ul class="nav navbar-nav float-right">
    <li class="dropdown dropdown-user nav-item">
        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
            <div class="user-nav d-sm-flex d-none">
                <span class="user-name text-bold-600"><?php echo $_SESSION['UserName']; ?></span>
                <span class="user-status">
                    <?php echo ($_SESSION['validity'] === "1") ? 'Admin' : 'User'; ?>
                </span>
            </div>
            <span>
                <img class="round" src="../../image/<?php 
                    // تحديد المجلد حسب نوع المستخدم
                    echo ($_SESSION['validity'] === "1") ? 'user' : 'shop'; 
                ?>/<?php echo $_SESSION['getImage_User']; ?>" alt="avatar" height="40" width="40">
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="?page1=<?php 
                echo ($_SESSION['validity'] === "1") ? 'Profile_Admin' : 'Profile_User'; 
            ?>">
                <i class="feather icon-user"></i> تعديل البروفايل
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="feather icon-power"></i> خروج
            </a>
        </div>
    </li>
</ul>
                </div>
            </div>
        </div>
    </nav>

	
     <script  type="text/javascript"> 
            var v = document.getElementById("p");
			
        	 var them=1;

         let result = document.querySelector('#result');
        document.body.addEventListener('change', function (e) {
            let target = e.target;
           
            switch (target.id) {
             
			    case 'light':
				
				   $.ajax({
        url: '../Control/them.php?load=Them',
        type: 'get',
		  dataType: 'JSON',
	    success: function(response){
				if(response[0].name=='0'){
	 v.className = "";		 
}	
	if(response[0].name=='1'){
	 v.className = "dark-layout";		 
}
        	alert(response[0].name); 	 
    }
    });
				     them = 0;
                    break;
                case 'dark':
				
				    them = 1;
                    break;
            }
	
/*	if(them==0){
	 v.className = "";		 
}	
	if(them==1){
	 v.className = "dark-layout";		 
}*/
        });
		
		
			/*function LoadThem(them) {

   $.ajax({
        url: '../Control/them.php?load=Them&&them='+them,
        type: 'get',
		  dataType: 'JSON',
	    success: function(response){
        	alert("rr"); 	 
    }
    });
 
		   }*/
    </script>