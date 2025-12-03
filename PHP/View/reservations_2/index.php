                               	<?php
								include('update.php'); 
?>	
  <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">حجوزات مرفوضة</h2>
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
                                <div class="card-header">
                                    <h4 class="card-title">   

									</h4>
                                </div>
                                <div class="card-content">
								                 

    
                                     <div  class="card-body card-dashboard">
                                        <p class="card-text"></p>
                                        <div class="table-responsive">
                                          
                       <table class="table zero-configuration 
											 table-striped table-bordered complex-headers">
				
                                                <thead>
                                                    <tr>		   
			    <th>الرقم</th>
                <th>اسم العميل</th>
                <th>رقم الجوال</th>
			    <th>تاريخ الحجز</th>
			    <th>اسم الحساب</th>
			    <th>رقم السند</th>
			    <th>التفاصيل</th>
			    <th>العمليات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												   
				

 <?php          
										if (isset($Display))
											if (count($Display) > 0) {
    for ($i = 0; $i < count($Display); $i++) {
     
        echo "<tr>
		<td>{$Display[$i]['id']}</td>
      <td>{$Display[$i]['name']}</td>
            <td>{$Display[$i]['phone']}</td>b
		    <td>{$Display[$i]['booking_date']}</td>
		    <td>{$Display[$i]['account_name']}</td>
       	    <td>{$Display[$i]['bond_no']}</td>
       	    <td>
			 <button data-toggle='modal' data-target='#modal_edit'
	 data-placement='bottom' title='تعديل' class='btn btn-outline-success waves-effect waves-light'  
  onclick='dispalyData(this)' 
  data-id='{$Display[$i]['id']}' data-name='{$Display[$i]['name']}' data-phone='{$Display[$i]['phone']}' data-booking_date='{$Display[$i]['booking_date']}' data-account_name='{$Display[$i]['account_name']}' data-bond_no='{$Display[$i]['bond_no']}' data-note='{$Display[$i]['note']}'  >
    <i class='fa fa-eye'>&nbsp;&nbsp;&nbsp;التفاصيل</i>
  </button>
			</td>
      <td><div class='btn-group btn-group-sm'>
	  <form class='form_delete' method='POST' action=''> <a class='delete_User' data-value='{$Display[$i]['id']}' data-toggle='tooltip' data-placement='left' title='إستعاة' onclick='return confirm(".'"هل تريدإستعادة الحجز إلى قائمة الحجوزات الجديدة"'.");'><input  class='id' type='hidden' name='id' value='{$Display[$i]['id']}'>
      <button class='btn btn-warning mr-1 mb-1' name='Delete'>
	إستعاة</button></a></form>
	  </div></td>
       </tr>";
    }
}
?>			
											   </tbody>
                                                <tfoot>
                                                    <tr>
			    <th>الرقم</th>
                <th>اسم العميل</th>
                <th>رقم الجوال</th>
			    <th>تاريخ الحجز</th>
			    <th>اسم الحساب</th>
			    <th>رقم السند</th>
			    <th>التفاصيل</th>
			    <th>العمليات</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
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