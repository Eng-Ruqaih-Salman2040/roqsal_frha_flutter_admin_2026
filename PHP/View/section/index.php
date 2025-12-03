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
                            <h2 class="content-header-title float-left mb-0"> بيانات الأقسام</h2>
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
                                                        اضافة قسم جديد
                                                    </button></h4>
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
                <th> الصورة الرمزية</th>
                <th> اسم القسم</th>
                <th> الترتيب</th>
                <th>الحالة</th>
			   <th> العمليات</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												   
				

 <?php          
										if (isset($Display))
											if (count($Display) > 0) {
    for ($i = 0; $i < count($Display); $i++) {
          if($Display[$i]['status']==="0"){
		 $status="<button type='button' class='btn btn-danger mr-1 mb-1'>موقف</button>";
	 }else{
		 $status="<button type='button' class='btn btn-success mr-1 mb-1'>مفعل</button>";
	 }
       $id=$i+1;
        echo "<tr>
      <td>{$id}</td>
	  <td><img style='height:35px;  width: 35px;'; class='img_doc_display'  src='../../image/section/{$Display[$i]['image']}'></td>
      <td>{$Display[$i]['name']}</td>
      <td>{$Display[$i]['sort']}</td>
	  <td>{$status}</td>
      <td><div class='btn-group btn-group-sm'>
	 
      <button data-toggle='modal' data-target='#modal_edit'
	 data-placement='bottom' title='تعديل' class='btn btn-link'  
  onclick='dispalyData(this)' 
  data-id='{$Display[$i]['id']}' data-name='{$Display[$i]['name']}' data-sort='{$Display[$i]['sort']}' data-status='{$Display[$i]['status']}'>
    <i class='fa fa-edit'></i>
  </button>
      <form class='form_delete' method='POST' action=''> <a class='delete_User' data-value='{$Display[$i]['id']}' data-toggle='tooltip' data-placement='left' title='حذف' onclick='return confirm(".'"Do you want to delete"'.");'><input  class='id' type='hidden' name='id' value='{$Display[$i]['id']}'>
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
                <th> الصورة الرمزية</th>
                <th> اسم القسم</th>
                <th> الترتيب</th>
                <th>الحالة</th>
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