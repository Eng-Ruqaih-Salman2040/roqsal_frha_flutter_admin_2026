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
                            <h2 class="content-header-title float-left mb-0">جميع الحجوزات</h2>
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
			    <th>اسم الصنف</th>
			    <th>رقم جوال الصنف</th>
				<th>سعر الحجز</th>  
			    <th>تاريخ الحجز</th>  
			    <th>حالة الحجز</th>
                <th>التفاصيل</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												   
				

 <?php          
										if (isset($Display))
											if (count($Display) > 0) {
    for ($i = 0; $i < count($Display); $i++) {
    
	
      if($Display[$i]['reservation_status']==="0") {
		 $statues="<button type='button' class='btn btn-warning mr-1 mb-1'>قيد الإنتظار</button>";
	 }
	  if($Display[$i]['reservation_status']==="1") {
		 $statues="<button type='button' class='btn btn-success mr-1 mb-1'>مقبول</button>";
	 }
	    if($Display[$i]['reservation_status']==="2"){
		 $statues="<button type='button' class='btn btn-danger mr-1 mb-1'>مرفوض</button>";
	 }
        echo "<tr>
		<td>{$Display[$i]['id']}</td>
      <td>{$Display[$i]['name']}</td>
            <td>{$Display[$i]['phone']}</td>b
		    <td>{$Display[$i]['shop_name']}</td>
		    <td>{$Display[$i]['shop_phone']}</td>
       	    <td>{$Display[$i]['price']}</td>
       	    <td>{$Display[$i]['booking_date']}</td>
       	    <td>{$statues}</td>
       	    <td>
			 <button data-toggle='modal' data-target='#modal_edit'
	 data-placement='bottom' title='تعديل' class='btn btn-outline-success waves-effect waves-light'  
  onclick='dispalyData(this)' 
  data-id='{$Display[$i]['id']}' data-name='{$Display[$i]['name']}' data-phone='{$Display[$i]['phone']}' data-booking_date='{$Display[$i]['booking_date']}' data-account_name='{$Display[$i]['account_name']}' data-bond_no='{$Display[$i]['bond_no']}' data-note='{$Display[$i]['note']}'  >
    <i class='fa fa-eye'>&nbsp;&nbsp;&nbsp;التفاصيل</i>
  </button>
			</td>
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
			    <th>اسم الصنف</th>
			    <th>رقم جوال الصنف</th>
				<th>سعر الحجز</th>  
			    <th>تاريخ الحجز</th>  
			    <th>حالة الحجز</th>
                <th>التفاصيل</th>
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