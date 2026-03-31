   <?php 
?>
  <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">تعديل البروفايل</h2>
                            <div class="breadcrumb-wrapper col-12">
                     
           <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="?page1=Dashboard">لوحة التحكم</a>
                                    </li>
                                    <li class="breadcrumb-item active">فرحة
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
             
            </div>
            <div class="content-body">

                <!-- Zero configuration table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                               <div class="card-body">
                       
                                <div class="tab-content">
                                    <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                        <form method="POST"  id="myForm" action="index.php?page1=Profile_User" enctype="multipart/form-data" role="form" novalidate>
						                            
			
															 <input type="hidden" id="id" name="id" value="<?php echo $_SESSION['getId_User'];?>">                                      
											<div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
													    <div class="controls">
                                                            <label>اسم الصنف</label>
                                                             <input type="text"  id="name" value="<?php echo $_SESSION['name'];?>" name="name" class="form-control" data-validation-required-message="الحقل مطلوب" placeholder="اسم الصنف">
                                                      </div>
                                                    </div>
													 <div class="form-group">
													    <div class="controls">
                                                            <label>اسم المستخدم</label>
                                                             <input type="text"  id="user_name" value="<?php echo $_SESSION['UserName'];?>" name="user_name" class="form-control" data-validation-required-message="الحقل مطلوب" placeholder="اسم المستخدم">
                                                      </div>
                                                    </div>
                                        			   <div class="form-group">
                                                       <label>كلمة المرور:</label>
                                                        <div class="controls">
                                                            <input type="password" id="password"  value="<?php echo $_SESSION['password'];?>" name="password" class="form-control" data-validation-required-message="الحقل مطلوب" placeholder="كلمة المرور">
                                                        </div>
                                                    </div>
									           
                                                  
													  <div class="form-group">
                                                           <label>E-mail</label>
                                        <div class="controls">
                                                       <input class="form-control" type="email" id="email" value="<?php echo $_SESSION['email'];?>" name="email" data-validation-required-message="الحقل مطلوب" placeholder="الايميل">
                                              </div>
                                                    </div>  
													
													   	<div class="form-group">
                                                     <label>رقم الجوال </label>
                                                        <div class="controls">
                                                            <input type="number" id="phone"  value="<?php echo $_SESSION['phone'];?>" name="phone" class="form-control" required data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="The numeric field may only contain numeric characters." placeholder=" رقم الجوال" >
                                                        </div>
                                                    </div> 
													 <div class="form-group">
													    <div class="controls">
                                                            <label>العنوان</label>
                                                             <input type="text"  id="address" value="<?php echo $_SESSION['address'];?>" name="address" class="form-control" data-validation-required-message="الحقل مطلوب" placeholder="العنوان">
                                                      </div>
                                                    </div>
														 <div class="form-group">
													    <div class="controls">
                                                            <label>عدد المشاهدات</label>
                                                             <input type="text"  id="viewer"  readonly="true" style="border: none; "  value="<?php echo $_SESSION['viewer'];?>" name="viewer" class="form-control" data-validation-required-message="الحقل مطلوب" placeholder="عدد المشاهدات">
                                                      </div>
                                                    </div>
													
                                                </div>
												
                                                <div class="col-12 col-sm-6">
												<div class="alert alert-primary" style="display:none" id="info">
                    <i class="feather icon-info mr-1"></i> عند تغيير الثيم يجب عليك تحديث الصفحة.
                </div>
  	  <div class="form-group">
                                                        <label>them</label>
                                                        <select name="layout_them" onchange="myFunction1()" class="form-control">
														<?php
//echo "dark-layout";
if($_SESSION['layout_them'] == 1){
      echo "<option value='0' >light</option>";
	  echo "<option value='1' selected>dark</option>";
}else{
      echo "<option value='0' selected>light</option>";
	  echo "<option value='1' >dark</option>";	
}?>
                                                      
                                                        </select>
                                                    </div>
													
                                                     <div class="form-group">		  
                                                        <label> المدينة </label>
                                                        <div class="controls">
												        <select name="city_id" id="city_id"  class="form-control">
														    <?php
											 if (isset($city))
                                          for ($i = 0; $i < count($city); $i++) {
                                            $city_name=$city[$i]['name'];
                                            $city_id=$city[$i]['id'];
											if($city_id=== $_SESSION['city_id'])
												$select="selected";
											else
													$select="";
											
                                            echo "<option value='$city_id' $select>$city_name </option>";
                                                }
                                         ?>
		                                                </select>
                                                        </div>
													</div>
                                                    <div class="form-group">
                                                       <div class="custom-file">
        <input type="file" name="imge" class="custom-file-input" id="imge">
        <label class="custom-file-label" for="chooseFile">الشعار</label>
      </div>
                                                    </div>
													 <div class="form-group">
													    <div class="controls">
                                                            <label>سعر الحجز</label>
                                                             <input type="number"  id="price"   value="<?php echo $_SESSION['price'];?>" name="price" class="form-control" data-validation-required-message="الحقل مطلوب" placeholder="سعر الحجز">
                                                      </div>
                                                    </div>
												
													
                                                 		 <div class="form-group">
                                            <label>وصف</label>
                                            <textarea class="form-control"  id="description"  name="description" placeholder="وصف" rows="7">
											<?php echo $_SESSION['description'];?>
											</textarea>
                                        
										</div>
                                                </div>

                                                  
                                                                                                 
			                                    <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <button type="submit" name="Update" form="myForm" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">
													حفظ التغيير
                                                   </button>
												     <button type="reset" onclick="myFunction()" class="btn btn-outline-warning">Reset</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- users edit account form ends -->
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Zero configuration table -->
              
               
            
            
            </div>
        </div>
    </div>
	
	                   <script type="text/javascript">

 
function myFunction1() {
   document.getElementById("info").style.display = "block"; 
   //none
} 
function myFunction() {
  document.getElementById("myForm").reset();
  
}
    
 </script>  