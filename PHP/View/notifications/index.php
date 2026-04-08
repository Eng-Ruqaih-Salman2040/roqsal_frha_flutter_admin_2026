                               	<?php
								include('update.php'); 
       include('add.php'); 
	     
?>	
  <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0"> الاشعارات</h2>
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
                                    <h4 class="card-title">           <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-outline-success waves-effect waves-light" data-toggle="modal" data-target="#defaultSize">
                                                        اضافة اشعار جديد
                                                    </button>
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
                <th> الرقم</th>
                <th> الاشعار</th>
				 <th> تاريخ الانشاء</th>
				 <th> وقت الانشاء</th>
			     <th> العمليات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												   
				

 <?php          
										if (isset($Display))
											if (count($Display) > 0) {
    for ($i = 0; $i < count($Display); $i++) {
     
     
          $id=$i+1;
        echo "<tr>
       <td>{$id}</td>
       <td>{$Display[$i]['note']}</td>
       <td>{$Display[$i]['date_create']}</td>
       <td>{$Display[$i]['time_create']}</td>
       <td><div class='btn-group btn-group-sm'>
	 											
    <button data-toggle='modal' data-target='#modal_edit'
	 data-placement='bottom' title='تعديل' class='btn btn-link'  
  onclick='dispalyData(this)' 
  data-id='{$Display[$i]['id']}' data-note='{$Display[$i]['note']}'>
    <i class='fa fa-edit'></i>
  </button>
      <form class='form_delete' method='POST' action=''> <a class='delete_notifications' data-value='{$Display[$i]['id']}' data-toggle='tooltip' data-placement='left' title='حذف' onclick='return confirm(".'"Do you want to delete"'.");'><input  class='id' type='hidden' name='id' value='{$Display[$i]['id']}'>
      <button class='btn btn-link text-danger' name='Delete'><i class='fa fa-trash'></i></button></a></form>
	  </div></td>
       </tr>";
    }
}
?>			
											   </tbody>
                                                <tfoot>
                                                    <tr>
          <th> الرقم</th>
                <th> الاشعار</th>
				 <th> تاريخ الانشاء</th>
				 <th> وقت الانشاء</th>
			     <th> العمليات</th>
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