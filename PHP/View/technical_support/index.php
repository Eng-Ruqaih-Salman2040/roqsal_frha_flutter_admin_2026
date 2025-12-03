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
                            <h2 class="content-header-title float-left mb-0"> الدعم الفني </h2>
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
                <th> الأسم</th>
                <th> الايميل</th>
			    <th> العنوان</th>
			    <th>  الرسالة</th>
			    <th> تاريخ انشائها</th>
			    <th> وقت انشائها</th>
			    <th> حالة الرسالة</th>

			   </tr>
                                                </thead>
                                                <tbody>
											

 <?php          
 
										if (isset($Display))
											if (count($Display) > 0) {
    for ($i = 0; $i < count($Display); $i++) {
     if($Display[$i]['status']==="1") {
		 $statues="<button type='button' class='btn btn-success mr-1 mb-1'>تمت القرائة</button>";
	 }
     if($Display[$i]['status']==="0") {
		 $statues="<form class='form_delete' method='POST' action=''> <a class='delete_User' data-value='{$Display[$i]['id']}' data-toggle='tooltip' data-placement='left'><input  class='id' type='hidden' name='id' value='{$Display[$i]['id']}'>
      <button class='btn btn-warning mr-1 mb-1' name='Delete'>لم يتم القرائة</button></a></form>";
	 }
         $id=$i+1;
        echo "<tr>
       <td>{$id}</td>
      <td>{$Display[$i]['name']}</td>
      <td>{$Display[$i]['email']}</td>
      <td>{$Display[$i]['subject']}</td>
      <td>{$Display[$i]['message']}</td>
      <td>{$Display[$i]['date_create']}</td>
      <td>{$Display[$i]['time_create']}</td>
	  <td>{$statues}</td>
	   </tr>";
    }
}
?>			
											   </tbody>
                                                <tfoot>
                                                    <tr>
  			   <th> الرقم</th>
                <th> الأسم</th>
                <th> الايميل</th>
			    <th> العنوان</th>
			    <th>  الرسالة</th>
			    <th> تاريخ انشائها</th>
			    <th> وقت انشائها</th>
			    <th> حالة الرسالة</th>

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
   
