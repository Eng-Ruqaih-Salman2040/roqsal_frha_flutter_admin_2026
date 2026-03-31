  <?php 
  function active($page) {
    if($_GET['page1']===$page){
		    echo 'active ';
				}
}
 ?>
  <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="../../html/rtl/vertical-menu-template/index.html">
                        <div class="brand-logo"></div>
                        <h2 class="brand-text mb-0">فرحة</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
              	<li class="<?php active("Dashboard");?> nav-item"><a href="?page1=Dashboard"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Email">لوحة التحكم</span></a>
                </li>
                <li class=" navigation-header"><span>Apps</span>
                </li>
			
					<?php 
				if($_SESSION['validity']==="1"){
		      echo '<li class="';
		      active("Profile_Admin");
              echo' nav-item"><a href="?page1=Profile_Admin"><i class="feather icon-user"></i><span class="menu-title" data-i18n="User">بروفايل</span></a>
                </li>';
				}?>
					<?php 
				if($_SESSION['validity']==="0"){
		      echo '<li class="';
		      active("Profile_User");
              echo' nav-item"><a href="?page1=Profile_User"><i class="feather icon-user"></i><span class="menu-title" data-i18n="User">بروفايل</span></a>
                </li>';
				}?>
				
						<?php 
				if($_SESSION['validity']==="1"){
		      echo '<li class="';
		      active("User");
              echo' nav-item"><a href="?page1=User"><i class="feather icon-users"></i><span class="menu-title" data-i18n="User">المستخدمين</span></a>
                </li>';
				}?>
					<?php 
				if($_SESSION['validity']==="1"){
		      echo '<li class="';
		      active("City");
              echo' nav-item"><a href="?page1=City"><i class="fa fa-map-marker"></i><span class="menu-title" data-i18n="User">المدن</span></a>
                </li>';
				}?>
									<?php 
				if($_SESSION['validity']==="1"){
		      echo '<li class="';
		      active("section");
              echo' nav-item"><a href="?page1=section"><i class="fa fa-tags"></i><span class="menu-title" data-i18n="User">الأقسام</span></a>
                </li>';
				}?>
				 	<?php 
				if($_SESSION['validity']==="1"){
		      echo '<li class="';
		      active("shop");
              echo' nav-item"><a href="?page1=shop"><i class="fa 
fa-calendar"></i><span class="menu-title" data-i18n="User">الخدمات</span></a>
                </li>';
				}?>
			 	<?php 
				if($_SESSION['validity']==="1"){
		      echo '<li class="';
		      active("bank_accounts");
              echo' nav-item"><a href="?page1=bank_accounts"><i class="fa 
fa-bank"></i><span class="menu-title" data-i18n="User">الحسابات</span></a>
                </li>';
				}?>
			
 						        	<?php 
				if($_SESSION['validity']==="1"){
		      echo '<li class="';
		      active("reservations_3");
              echo' nav-item"><a href="?page1=reservations_3"><i class="fa 
fa-ticket"></i><span class="menu-title" data-i18n="User">جميع الحجوزات</span></a>
                </li>';
				}?>
                   	<?php 
				if($_SESSION['validity']==="1"){
		      echo '<li class="';
		      active("rating");
              echo' nav-item"><a href="?page1=rating"><i class="fa 
			  fa-star"></i><span class="menu-title" data-i18n="User">تقيماتي</span></a>
                </li>';
				}?>  
         
				<?php 
				if($_SESSION['validity']==="1"){
		      echo '<li class="';
		      active("technical_support");
              echo' nav-item"><a href="?page1=technical_support"><i class="fa 
fa-comments"></i><span class="menu-title" data-i18n="User">الدعم الفني</span></a>
                </li>';
				}?>
				 	<?php 
				if($_SESSION['validity']==="1"){
		      echo '<li class="';
		      active("notifications");
              echo' nav-item"><a href="?page1=notifications"><i class="fa 
fa-bell"></i><span class="menu-title" data-i18n="User">اشعارات التطبيق</span></a>
                </li>';
				}?>
				 	 	<?php 
				if($_SESSION['validity']==="1"){
		      echo '<li class="';
		      active("ads");
              echo' nav-item"><a href="?page1=ads"><i class="fa 
fa-bullhorn"></i><span class="menu-title" data-i18n="User">اعلانات التطبيق</span></a>
                </li>';
				}?>

					 	<?php 
				if($_SESSION['validity']==="1"){
		      echo '<li class="';
		      active("Reports");
              echo' nav-item"><a href="?page1=Reports"><i class="fa 
fa-bullhorn"></i><span class="menu-title" data-i18n="User"> التقارير </span></a>
                </li>';
				}?>
				 
           	<?php 
				if($_SESSION['validity']==="0"){
		      echo '<li class="';
		      active("gallery");
              echo' nav-item"><a href="?page1=gallery"><i class="fa 
fa-image"></i><span class="menu-title" data-i18n="User">صور الخدمة</span></a>
                </li>';
				}?> 
               	<?php 
				if($_SESSION['validity']==="0"){
		      echo '<li class="';
		      active("reservations");
              echo' nav-item"><a href="?page1=reservations"><i class="fa 
fa-hospital-o"></i><span class="menu-title" data-i18n="User">حجوزات جديدة</span></a>
                </li>';
				}?>
				
				        	<?php 
				if($_SESSION['validity']==="0"){
		      echo '<li class="';
		      active("reservations_2");
              echo' nav-item"><a href="?page1=reservations_2"><i class="fa 
fa-hospital-o"></i><span class="menu-title" data-i18n="User">حجوزات مرفوضه</span></a>
                </li>';
				}?>
						        	<?php 
				if($_SESSION['validity']==="0"){
		      echo '<li class="';
		      active("reservations_1");
              echo' nav-item"><a href="?page1=reservations_1"><i class="fa 
fa-hospital-o"></i><span class="menu-title" data-i18n="User">حجوزات مؤكدة</span></a>
                </li>';
				}?>
          
		      	 	<?php 
				if($_SESSION['validity']==="0"){
		      echo '<li class="';
		      active("bank_accounts_user");
              echo' nav-item"><a href="?page1=bank_accounts_user"><i class="fa 
fa-bank"></i><span class="menu-title" data-i18n="User">حساباتي</span></a>
                </li>';
				}?>
					<?php 
				if($_SESSION['validity']==="0"){
		      echo '<li class="';
		      active("rating");
              echo' nav-item"><a href="?page1=rating"><i class="fa 
			  fa-star"></i><span class="menu-title" data-i18n="User">تقيماتي</span></a>
                </li>';
				}?>
				
              
                 
            
           
            </ul>
        </div>
    </div>
 